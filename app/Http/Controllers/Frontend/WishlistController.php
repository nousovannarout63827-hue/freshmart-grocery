<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     */
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $totalCount = $wishlists->count();

        return view('frontend.wishlist', compact('wishlists', 'totalCount'));
    }

    /**
     * Add a product to the wishlist.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Check if it already exists
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($exists) {
            return back()->with('info', 'Product is already in your wishlist!');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'Added to wishlist! 💚');
    }

    /**
     * Remove a product from the wishlist.
     */
    public function remove($id)
    {
        Wishlist::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Removed from wishlist.');
    }

    /**
     * Toggle wishlist status (add/remove).
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed', 'message' => 'Removed from wishlist.']);
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ]);
            return response()->json(['status' => 'added', 'message' => 'Added to wishlist! 💚']);
        }
    }
}
