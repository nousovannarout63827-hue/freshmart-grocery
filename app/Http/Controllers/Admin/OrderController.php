<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // 1. Start a base query
        $query = Order::with('customer')->latest();

        // 2. Filter by exact Order ID
        if ($request->filled('order_id')) {
            // We use ltrim just in case the admin typed "#5" instead of just "5"
            $orderId = ltrim($request->order_id, '#');
            $query->where('id', $orderId);
        }

        // 3. Filter by Customer Name or Email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // 4. Filter by Date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 5. Filter by Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // 6. Get the results AND append the search terms to the pagination links!
        $orders = $query->paginate(15)->appends($request->all());

        // Keep the pending count for the top alert badge
        $pendingCount = Order::whereIn('status', ['pending', 'preparing'])->count();

        // Calculate total sold amount for delivered orders (filtered)
        $totalSoldAmount = (clone $query)->where('status', 'delivered')->sum('total_amount');

        return view('admin.orders.index', compact('orders', 'pendingCount', 'totalSoldAmount'));
    }

    public function show($id)
    {
        // Fetch the order with the customer data and the purchased products
        $order = Order::with(['customer', 'driver', 'orderItems.product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        // Validate that the staff selected a valid status
        $request->validate([
            'status' => 'required|in:pending,preparing,ready_for_pickup,out_for_delivery,arrived,delivered,cancelled',
            'cancellation_reason' => 'nullable|string|max:1000',
            'driver_id' => 'nullable|exists:users,id'
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;

        // Handle driver assignment
        if ($request->has('driver_id')) {
            $order->driver_id = $request->driver_id;

            // If assigning a driver and order is not yet out for delivery, update status
            if ($request->driver_id && !in_array($order->status, ['out_for_delivery', 'arrived', 'delivered'])) {
                $order->status = 'out_for_delivery';
            } elseif (!$request->driver_id) {
                // If removing driver, set status back to ready_for_pickup
                if (in_array($order->status, ['out_for_delivery', 'arrived'])) {
                    $order->status = 'ready_for_pickup';
                }
            }
        }

        // Handle status update
        if ($request->has('status')) {
            $order->status = $request->status;

            // Save cancellation reason if status is cancelled
            if ($request->status === 'cancelled') {
                $order->cancellation_reason = $request->cancellation_reason;
                
                // Send notification to customer about order cancellation
                $this->notifyCustomerAboutCancellation($order, $request->cancellation_reason);
            } else {
                // Clear cancellation reason if status is changed away from cancelled
                $order->cancellation_reason = null;
            }

            // 🔴 Smart Logic: If order is delivered, mark as PAID (customer paid the driver)
            if ($request->status === 'delivered') {
                $order->payment_status = 'paid';
            }
        }

        $order->save();

        return back()->with('success', 'Order has been updated successfully!');
    }

    /**
     * Send notification to customer when their order is cancelled by Admin/Staff
     */
    private function notifyCustomerAboutCancellation($order, $reason)
    {
        $customer = User::find($order->customer_id);
        
        if ($customer) {
            $customer->notifications()->create([
                'id' => \Illuminate\Support\Str::orderedUuid(),
                'type' => 'order_cancelled',
                'data' => [
                    'title' => 'Order Cancelled',
                    'message' => "Your order #{$order->id} has been cancelled by our staff.",
                    'reason' => $reason,
                    'order_id' => $order->id,
                    'cancelled_by' => auth()->user()->name ?? 'Admin/Staff',
                ],
            ]);
        }
    }

    /**
     * Confirm order and start preparation
     */
    public function confirmOrder($id)
    {
        $order = Order::findOrFail($id);
        
        if ($order->status !== 'pending') {
            return back()->with('error', 'Order cannot be confirmed. Current status: ' . $order->status);
        }

        $order->update(['status' => 'preparing']);

        return back()->with('success', 'Order confirmed! Staff is now preparing items.');
    }

    /**
     * Mark order as ready for pickup (driver can accept)
     */
    public function markReadyForPickup($id)
    {
        $order = Order::findOrFail($id);
        
        if (!in_array($order->status, ['pending', 'preparing'])) {
            return back()->with('error', 'Order cannot be marked as ready. Current status: ' . $order->status);
        }

        $order->update(['status' => 'ready_for_pickup']);

        return back()->with('success', 'Order is ready for pickup! Drivers can now accept this order.');
    }

    public function invoice($id)
    {
        $order = Order::with(['customer', 'orderItems.product'])->findOrFail($id);

        return view('admin.orders.invoice', compact('order'));
    }

    /**
     * Delete an order (Admin only).
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order #' . $id . ' has been deleted successfully.');
    }
}
