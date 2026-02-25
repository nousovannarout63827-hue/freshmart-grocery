<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewHelpful;
use App\Models\ReviewReply;
use App\Models\Product;
use App\Models\Order;
use App\Notifications\ReviewReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display customer's review history.
     */
    public function myReviews(Request $request)
    {
        // Require authentication
        if (!auth()->check()) {
            return redirect()->route('customer.login')
                ->with('error', 'Please log in to view your reviews.');
        }

        $userId = auth()->id();

        // Get user's reviews with product relationship
        $query = Review::where('user_id', $userId)
            ->with(['product'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true)->where('is_banned', false);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false)->where('is_banned', false);
            } elseif ($request->status === 'banned') {
                $query->where('is_banned', true);
            }
        }

        $reviews = $query->paginate(10);

        // Get statistics
        $stats = [
            'total' => Review::where('user_id', $userId)->count(),
            'approved' => Review::where('user_id', $userId)->where('is_approved', true)->where('is_banned', false)->count(),
            'pending' => Review::where('user_id', $userId)->where('is_approved', false)->where('is_banned', false)->count(),
            'banned' => Review::where('user_id', $userId)->where('is_banned', true)->count(),
        ];

        return view('frontend.customer.reviews', compact('reviews', 'stats'));
    }

    /**
     * Store a new review for a product.
     */
    public function store(Request $request)
    {
        // Require authentication
        if (!auth()->check()) {
            return redirect()->route('customer.login')
                ->with('error', 'Please log in to write a review.');
        }

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:2000',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'order_id' => 'nullable|exists:orders,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::findOrFail($request->product_id);
        $userId = auth()->id();

        // Check if user already reviewed this product
        $existingReview = Review::where('product_id', $product->id)
            ->where('user_id', $userId)
            ->first();

        if ($existingReview) {
            return redirect()->back()
                ->with('error', 'You have already reviewed this product. You can update your existing review from your profile.');
        }

        // Optionally verify the user purchased the product
        $verifiedPurchase = false;
        if ($request->order_id) {
            $order = Order::where('id', $request->order_id)
                ->where('customer_id', $userId)
                ->first();
            
            if ($order) {
                $verifiedPurchase = $order->orderItems()
                    ->where('product_id', $product->id)
                    ->exists();
            }
        } else {
            // Check if user has any order with this product
            $verifiedPurchase = Order::where('customer_id', $userId)
                ->whereHas('orderItems', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })
                ->exists();
        }

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create the review
        $review = Review::create([
            'product_id' => $product->id,
            'user_id' => $userId,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'images' => !empty($imagePaths) ? $imagePaths : null,
            'is_approved' => true, // Auto-approve, can be changed in admin
            'helpful_count' => 0,
        ]);

        return redirect()->back()
            ->with('success', 'Thank you for your review!');
    }

    /**
     * Update an existing review.
     */
    public function update(Request $request, $id)
    {
        // Require authentication
        if (!auth()->check()) {
            return redirect()->route('customer.login')
                ->with('error', 'Please log in to update your review.');
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:2000',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $review = Review::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Handle image uploads (add new images)
        if ($request->hasFile('images')) {
            $existingImages = $review->images ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $existingImages[] = $path;
            }
            $review->images = $existingImages;
        }

        // Update review
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()
            ->with('success', 'Review updated successfully!');
    }

    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        // Require authentication
        if (!auth()->check()) {
            return redirect()->route('customer.login')
                ->with('error', 'Please log in to delete your review.');
        }

        $review = Review::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Delete associated images
        if (!empty($review->images)) {
            foreach ($review->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $review->delete();

        return redirect()->back()
            ->with('success', 'Review deleted successfully!');
    }

    /**
     * Mark a review as helpful.
     */
    public function markHelpful($id)
    {
        // Require authentication
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please log in to mark reviews as helpful.',
            ], 401);
        }

        $review = Review::findOrFail($id);
        $userId = auth()->id();

        // Check if user already marked this review as helpful
        $existingVote = ReviewHelpful::where('review_id', $review->id)
            ->where('user_id', $userId)
            ->first();

        if ($existingVote) {
            // Unlike - remove the vote
            $existingVote->delete();
            $review->decrement('helpful_count');

            return response()->json([
                'success' => true,
                'helpful' => false,
                'helpful_count' => $review->helpful_count,
            ]);
        }

        // Like - add the vote
        ReviewHelpful::create([
            'review_id' => $review->id,
            'user_id' => $userId,
        ]);
        $review->increment('helpful_count');

        return response()->json([
            'success' => true,
            'helpful' => true,
            'helpful_count' => $review->helpful_count,
        ]);
    }

    /**
     * Filter reviews by rating.
     */
    public function filter(Request $request, $productId)
    {
        $query = Review::where('product_id', $productId)
            ->where('is_approved', true)
            ->with('user');

        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Filter by verified purchase
        if ($request->filled('verified') && $request->verified === '1') {
            $query->whereNotNull('order_id');
        }

        // Filter by with images
        if ($request->filled('with_images') && $request->with_images === '1') {
            $query->whereNotNull('images');
        }

        // Sort
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'highest':
                $query->orderBy('rating', 'desc');
                break;
            case 'lowest':
                $query->orderBy('rating', 'asc');
                break;
            case 'helpful':
                $query->orderBy('helpful_count', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $reviews = $query->paginate(10);

        return response()->json([
            'success' => true,
            'reviews' => $reviews->items(),
            'pagination' => [
                'current_page' => $reviews->currentPage(),
                'last_page' => $reviews->lastPage(),
                'per_page' => $reviews->perPage(),
                'total' => $reviews->total(),
            ],
        ]);
    }

    /**
     * Store a reply to a review.
     */
    public function storeReply(Request $request, $reviewId)
    {
        // Require authentication
        if (!auth()->check()) {
            return redirect()->route('customer.login')
                ->with('error', 'Please log in to reply to reviews.');
        }

        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $review = Review::findOrFail($reviewId);

        // Create the reply
        $reply = ReviewReply::create([
            'review_id' => $review->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        // Send notification to review author (if not replying to own review)
        if ($review->user_id !== auth()->id() && $review->user) {
            $review->user->notify(new ReviewReplyNotification($reply));
        }

        return redirect()->back()
            ->with('success', 'Reply posted successfully!');
    }

    /**
     * Delete a reply.
     */
    public function destroyReply($id)
    {
        // Require authentication
        if (!auth()->check()) {
            return redirect()->route('customer.login')
                ->with('error', 'Please log in to delete your reply.');
        }

        $reply = ReviewReply::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $reply->delete();

        return redirect()->back()
            ->with('success', 'Reply deleted successfully!');
    }
}
