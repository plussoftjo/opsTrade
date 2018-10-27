<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class replayNotfy extends Notification
{
     use Queueable;

    public $user;
    public $comment_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$comment_id)
    {
        $this->user = $user;
        $this->comment_id = $comment_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->comment_id,
            'name' => $this->user->name,
            'message' => $this->user->name.' Has Replay To Your Comment',
            'image' => $this->user->avatar
        ];
    }
}
