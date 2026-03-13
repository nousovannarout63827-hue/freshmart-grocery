<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Apply coupon code to the cart.
     */
    public function apply(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|max:50',
        ]);

        $couponCode = strtoupper(trim($request->coupon_code));

        // Find the active coupon in the database
        $coupon = Coupon::where('code', $couponCode)
                        ->where('status', true)
                        ->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid coupon code. Please check and try again.');
        }

        // Check if coupon is expired
        if (!$coupon->isValid()) {
            return back()->with('error', 'This coupon has expired or is no longer active.');
        }

        // Calculate cart subtotal from session
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Check if cart is empty
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty. Add items before applying a coupon.');
        }

        // Check minimum purchase requirement BEFORE calculating discount
        if ($subtotal < $coupon->min_purchase) {
            return back()->with('error', 'Minimum purchase of $' . number_format($coupon->min_purchase, 2) . ' required for this coupon. Your current subtotal is $' . number_format($subtotal, 2) . '.');
        }

        // Calculate the discount
        $discountAmount = $coupon->calculateDiscount($subtotal);

        if ($discountAmount <= 0) {
            return back()->with('error', 'This coupon cannot be applied to your current order. Please check the coupon requirements.');
        }

        // Save the coupon data into the session
        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $discountAmount,
            'type' => $coupon->type,
            'value' => $coupon->value,
        ]);

        return back()->with('success', 'Coupon "' . $coupon->code . '" applied successfully! You saved $' . number_format($discountAmount, 2) . '.');
    }

    /**
     * Remove coupon from the cart.
     */
    public function remove()
    {
        session()->forget('coupon');
        return back()->with('success', 'Coupon removed.');
    }
}
