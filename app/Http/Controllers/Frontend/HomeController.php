<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Get all categories with product count (shows empty categories too)
        $categories = Category::withCount('products')->get();

        // Get the latest products to show on the homepage (increased from 8 to 12)
        $latestProducts = Product::where('stock', '>', 0)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->latest()
            ->take(12)
            ->get();

        return view('frontend.home', compact('categories', 'latestProducts'));
    }

    /**
     * Display customer's order history.
     */
    public function myOrders()
    {
        // Get the currently logged-in user
        $user = auth()->user();
        
        // Fetch their specific orders with items
        $orders = $user->orders()->with('orderItems.product')->latest()->paginate(5);

        return view('frontend.orders.index', compact('orders'));
    }

    /**
     * Display the shop page with all products.
     */
    public function shop(Request $request)
    {
        $query = Product::with('category')
            ->where('stock', '>', 0)
            ->whereNotNull('slug')
            ->where('slug', '!=', '');

        // Search Filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Price Range Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'latest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            // Default sort: latest first
            $query->latest();
        }

        $products = $query->paginate(12)->appends($request->all());
        $categories = Category::withCount('products')->get();

        return view('frontend.shop', compact('products', 'categories'));
    }

    /**
     * Display products by category.
     */
    public function categoryView($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->where('stock', '>', 0)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->with('category')
            ->latest()
            ->paginate(12);
        $categories = Category::withCount('products')->get();

        return view('frontend.category', compact('category', 'products', 'categories'));
    }

    /**
     * Display a single product.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->take(4)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    /**
     * Add product to cart.
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity;
            // Update image if it was previously null
            if (empty($cart[$productId]['image']) && $product->image) {
                $cart[$productId]['image'] = $product->image;
            }
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Display the cart page.
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        $categories = Category::has('products')->get();
        
        return view('frontend.cart', compact('cart', 'categories'));
    }

    /**
     * Update cart item quantity.
     */
    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $product = Product::findOrFail($productId);

            if ($request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'Not enough stock available.');
            }

            if ($request->quantity > 0) {
                $cart[$productId]['quantity'] = $request->quantity;
            } else {
                unset($cart[$productId]);
            }
        }

        session()->put('cart', $cart);

        // 🛡️ COUPON WATCHDOG: Re-validate coupon after cart update
        $couponRemoved = $this->validateCouponForCart($cart);

        $message = 'Cart updated!';
        if ($couponRemoved) {
            $message .= ' Coupon removed as subtotal is now below minimum requirement.';
        }

        return redirect()->back()->with($couponRemoved ? 'warning' : 'success', $message);
    }

    /**
     * Remove item from cart.
     */
    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            
            // 🛡️ COUPON WATCHDOG: Re-validate coupon after removal
            $couponRemoved = $this->validateCouponForCart($cart);
            
            $message = 'Item removed from cart!';
            if ($couponRemoved) {
                $message .= ' Coupon removed as subtotal is now below minimum requirement.';
            }
            
            return redirect()->back()->with($couponRemoved ? 'warning' : 'success', $message);
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }

    /**
     * Clear the entire cart.
     */
    public function clearCart()
    {
        session()->forget('cart');
        // 🛡️ COUPON WATCHDOG: Remove coupon when cart is cleared
        session()->forget('coupon');
        return redirect()->back()->with('success', 'Cart cleared!');
    }

    /**
     * Validate if the current cart meets coupon requirements.
     * Removes coupon if minimum purchase is no longer met.
     * Returns true if coupon was removed, false otherwise.
     */
    private function validateCouponForCart($cart)
    {
        // 1. Calculate the new subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // 2. 🛡️ Check if coupon exists and is still valid
        if (session()->has('coupon')) {
            $coupon = session()->get('coupon');
            
            // Fetch the coupon from database to check min_purchase
            $couponModel = \App\Models\Coupon::where('code', $coupon['code'])->first();
            
            if ($couponModel && $subtotal < $couponModel->min_purchase) {
                // Subtotal is now below minimum purchase requirement
                session()->forget('coupon');
                
                // Log for debugging
                \Log::info("Coupon removed: Subtotal ($" . $subtotal . ") below minimum ($" . $couponModel->min_purchase . ")");
                
                return true; // Coupon was removed
            }
        }
        
        return false; // Coupon still valid
    }

    /**
     * Display the checkout page.
     */
    public function checkout()
    {
        // Require authentication
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please log in to complete your checkout.');
        }
        
        $cart = session()->get('cart', []);
        $categories = Category::has('products')->get();
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }
        
        return view('frontend.checkout', compact('cart', 'categories'));
    }

    /**
     * Process the checkout order.
     */
    public function processCheckout(Request $request)
    {
        // Require authentication
        if (!auth()->check()) {
            return redirect()->route('customer.login')
                ->with('error', 'Please log in to complete your checkout.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^[0-9]{10,15}$/|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,card',
            'shipping_cost' => 'nullable|numeric|min:0|max:100',
        ], [
            'phone.regex' => 'Phone number must contain only digits (10-15 digits).',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Shipping rules - Free standard shipping over $50
        $deliveryThreshold = 50.00;
        $standardShippingRate = 6.00;
        $shippingDiscount = ($subtotal >= $deliveryThreshold) ? $standardShippingRate : 0;

        // Get shipping cost from request and apply discount if eligible
        $submittedShipping = $request->shipping_cost ?? 6.00;
        $shippingCost = max(0, $submittedShipping - $shippingDiscount); // Prevent negative

        // Get discount from coupon session
        $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0;

        // Calculate the final total on the server side to prevent hacking
        $finalTotal = ($subtotal + $shippingCost) - $discount;

        // Ensure total doesn't go negative
        $finalTotal = max(0, $finalTotal);

        // Create the order (matching actual orders table schema)
        try {
            $order = \App\Models\Order::create([
                'customer_id' => auth()->id(),
                'total_amount' => $finalTotal,
                'phone' => $request->phone,
                'delivery_address' => $request->address . ', ' . $request->city . ' ' . $request->postal_code,
                'address' => $request->address . ', ' . $request->city . ' ' . $request->postal_code,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cash' ? 'unpaid' : 'paid',
            ]);

            // Create order items
            foreach ($cart as $productId => $item) {
                // Ensure product_id is an integer
                $productId = (int) $productId;

                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);

                // Reduce product stock
                $product = \App\Models\Product::find($productId);
                if ($product && $product->stock > 0) {
                    $newStock = max(0, $product->stock - $item['quantity']);
                    $product->stock = $newStock;
                    $product->save();

                    // Log stock change for debugging
                    \Log::info("Product {$product->name} stock updated: {$product->stock} -> {$newStock}");
                }
            }

            // Log activity
            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'order_placed',
                'module' => 'Orders',
                'description' => 'Customer placed order #' . $order->id,
                'ip_address' => $request->ip(),
            ]);

            // Clear cart and coupon after successful order
            session()->forget('cart');
            session()->forget('coupon');

            return redirect()->route('customer.profile')
                ->with('success', 'Order placed successfully! Your order ID is: ' . $order->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }
    }
}
