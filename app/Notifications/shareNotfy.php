<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class shareNotfy extends Notification
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
            'id' => $this->post_id,
            'name' => $this->user->name,
            'message' => $this->user->name.' Has Like Your Post',
            'image' => $this->user->avatar,
            'type' => 'post'
        ];
    }
}
