<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewManagementController extends Controller
{
    /**
     * Display the review management dashboard.
     */
    public function index(Request $request)
    {
        // Get filter values
        $status = $request->get('status', 'all'); // all, pending, approved, flagged, banned
        $search = $request->get('search', '');
        $rating = $request->get('rating', '');
        $sortBy = $request->get('sort', 'latest');

        // Build query
        $query = Review::with(['product', 'user', 'moderator', 'replies.user']);

        // Apply filters
        switch ($status) {
            case 'pending':
                $query->where('is_approved', false)->where('is_banned', false);
                break;
            case 'approved':
                $query->where('is_approved', true)->where('is_banned', false);
                break;
            case 'flagged':
                $query->where('is_flagged', true)->where('is_banned', false);
                break;
            case 'banned':
                $query->where('is_banned', true);
                break;
            default:
                // Show all except banned by default
                break;
        }

        // Search filter
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('comment', 'like', "%{$search}%");
        }

        // Rating filter
        if ($rating) {
            $query->where('rating', $rating);
        }

        // Sorting
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('reviews.created_at', 'asc');
                break;
            case 'rating_high':
                $query->orderBy('reviews.rating', 'desc');
                break;
            case 'rating_low':
                $query->orderBy('reviews.rating', 'asc');
                break;
            case 'helpful':
                $query->orderBy('reviews.helpful_count', 'desc');
                break;
            case 'flagged':
                $query->orderBy('reviews.is_flagged', 'desc')
                      ->orderBy('reviews.created_at', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('reviews.created_at', 'desc');
                break;
        }

        $reviews = $query->paginate(20)->appends($request->all());

        // Statistics
        $stats = [
            'total' => Review::count(),
            'approved' => Review::where('is_approved', true)->where('is_banned', false)->count(),
            'pending' => Review::where('is_approved', false)->where('is_banned', false)->count(),
            'flagged' => Review::where('is_flagged', true)->where('is_banned', false)->count(),
            'banned' => Review::where('is_banned', true)->count(),
        ];

        return view('admin.reviews.index', compact('reviews', 'stats', 'status', 'search', 'rating', 'sortBy'));
    }

    /**
     * Display the details of a specific review.
     */
    public function show($id)
    {
        $review = Review::with(['product', 'user', 'moderator', 'helpfulVotes.user', 'replies.user'])->findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Approve a review.
     */
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->approve();
        $review->unflag();

        // Log activity
        activityLog('Approved review #' . $id . ' by ' . $review->user->name, 'Reviews');

        return redirect()->back()->with('success', 'Review approved successfully!');
    }

    /**
     * Reject a review.
     */
    public function reject($id)
    {
        $review = Review::findOrFail($id);
        $review->reject();

        activityLog('Rejected review #' . $id . ' by ' . $review->user->name, 'Reviews');

        return redirect()->back()->with('success', 'Review rejected!');
    }

    /**
     * Flag a review for moderation.
     */
    public function flag($id)
    {
        $review = Review::findOrFail($id);
        
        // Toggle: if already flagged, unflag it; otherwise flag it
        if ($review->is_flagged) {
            $review->unflag();
            return redirect()->back()->with('success', 'Review unflagged!');
        } else {
            $review->flag();
            return redirect()->back()->with('success', 'Review flagged for moderation!');
        }
    }

    /**
     * Ban a review.
     */
    public function ban(Request $request, $id)
    {
        $request->validate([
            'ban_reason' => 'required|string|max:500',
        ]);

        $review = Review::findOrFail($id);
        $review->ban($request->ban_reason);

        // Optionally suspend the user if they have multiple banned reviews
        $bannedCount = Review::where('user_id', $review->user_id)
                            ->where('is_banned', true)
                            ->count();

        $userSuspended = false;
        if ($bannedCount >= 3) {
            // User has 3 or more banned reviews - flag for admin review
            $userSuspended = true;
        }

        activityLog(
            'Banned review #' . $id . ' by ' . $review->user->name . '. Reason: ' . $request->ban_reason,
            'Reviews'
        );

        return redirect()->back()->with('success', 'Review banned!' . ($userSuspended ? ' User has multiple violations.' : ''));
    }

    /**
     * Unban a review.
     */
    public function unban($id)
    {
        $review = Review::findOrFail($id);
        $review->unban();

        activityLog('Unbanned review #' . $id, 'Reviews');

        return redirect()->back()->with('success', 'Review unbanned!');
    }

    /**
     * Delete a review permanently.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        activityLog('Permanently deleted review #' . $id, 'Reviews');

        return redirect()->route('admin.reviews.index')
                        ->with('success', 'Review deleted permanently!');
    }

    /**
     * Bulk actions for reviews.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'review_ids' => 'required|array',
            'action' => 'required|in:approve,reject,flag,ban,delete',
            'ban_reason' => 'nullable|string|max:500',
        ]);

        $count = 0;
        foreach ($request->review_ids as $reviewId) {
            $review = Review::find($reviewId);
            if (!$review) continue;

            switch ($request->action) {
                case 'approve':
                    $review->approve();
                    $review->unflag();
                    break;
                case 'reject':
                    $review->reject();
                    break;
                case 'flag':
                    $review->flag();
                    break;
                case 'ban':
                    $review->ban($request->ban_reason ?? 'Bulk moderation action');
                    break;
                case 'delete':
                    $review->delete();
                    break;
            }
            $count++;
        }

        activityLog("Bulk action '{$request->action}' performed on {$count} reviews", 'Reviews');

        return redirect()->back()->with('success', "Successfully performed {$request->action} on {$count} reviews!");
    }

    /**
     * Get review statistics for dashboard.
     */
    public function statistics()
    {
        $stats = [
            'total_reviews' => Review::count(),
            'approved_reviews' => Review::where('is_approved', true)->where('is_banned', false)->count(),
            'pending_reviews' => Review::where('is_approved', false)->where('is_banned', false)->count(),
            'flagged_reviews' => Review::where('is_flagged', true)->where('is_banned', false)->count(),
            'banned_reviews' => Review::where('is_banned', true)->count(),
            'average_rating' => round(Review::where('is_approved', true)->where('is_banned', false)->avg('rating'), 2),
            'reviews_today' => Review::whereDate('created_at', today())->count(),
            'reviews_this_week' => Review::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        // Top reviewed products
        $topReviewedProducts = Product::withCount(['approvedReviews as reviews_count' => function ($query) {
            $query->where('is_banned', false);
        }])
        ->orderByDesc('reviews_count')
        ->take(5)
        ->get();

        // Most helpful reviews
        $mostHelpfulReviews = Review::with(['product', 'user'])
            ->where('is_approved', true)
            ->where('is_banned', false)
            ->orderByDesc('helpful_count')
            ->take(5)
            ->get();

        return view('admin.reviews.statistics', compact('stats', 'topReviewedProducts', 'mostHelpfulReviews'));
    }

    /**
     * Delete a review reply (admin only).
     */
    public function destroyReply($id)
    {
        $reply = \App\Models\ReviewReply::findOrFail($id);
        $reviewId = $reply->review_id;
        
        $reply->delete();
        
        // Log activity
        activityLog('Deleted reply #' . $id . ' on review #' . $reviewId, 'Reviews');
        
        return redirect()->back()
            ->with('success', 'Reply deleted successfully!');
    }
}

/**
 * Helper function for activity logging.
 */
function activityLog($description, $module)
{
    if (auth()->check()) {
        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Review Moderation',
            'module' => $module,
            'description' => $description,
        ]);
    }
}
