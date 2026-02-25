<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ReviewReply;

class ReviewReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reply;
    protected $review;

    /**
     * Create a new notification instance.
     */
    public function __construct(ReviewReply $reply)
    {
        $this->reply = $reply;
        $this->review = $reply->review;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $replierName = $this->reply->user->name ?? 'Someone';
        $productName = $this->review->product->name ?? 'a product';
        
        return (new MailMessage)
            ->subject('Someone replied to your review!')
            ->greeting('Hi ' . ($notifiable->name ?? 'there') . '!')
            ->line($replierName . ' replied to your review on "' . $productName . '".')
            ->line('Here\'s what they said:')
            ->line('"' . Str::limit($this->reply->comment, 100) . '"')
            ->action('View Review', route('product.show', $this->review->product->slug))
            ->line('Thank you for being a valued customer!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'review_reply',
            'reply_id' => $this->reply->id,
            'review_id' => $this->review->id,
            'product_id' => $this->review->product_id,
            'product_name' => $this->review->product->name ?? 'Product',
            'product_slug' => $this->review->product->slug,
            'replier_id' => $this->reply->user_id,
            'replier_name' => $this->reply->user->name ?? 'Someone',
            'reply_comment' => $this->reply->comment,
        ];
    }
}
