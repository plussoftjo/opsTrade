<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class postNotfy extends Notification
{
    use Queueable;

    public $user;
    public $post_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$post_id)
    {
        $this->user = $user;
        $this->post_id = $post_id;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->user->name,
            'message' => $this->user->name.' Share New Post ',
            'id' => $this->post_id,
            'image' => $this->user->avatar,
            'type' => 'post'
        ];
    }
}
