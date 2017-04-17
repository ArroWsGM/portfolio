<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newMessageNotification extends Notification
{
    use Queueable;

    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->message = $msg;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $list = '<ul>';
        $list .= '<li><strong>From:</strong> ' . $this->message['name'] . '</li>';
        $list .= '<li><strong>Subject:</strong> ' . $this->message['subject'] . '</li>';
        if($this->message['email'])
            $list .= '<li><strong>Email:</strong> ' . $this->message['email'] . '</li>';
        if($this->message['phone'])
            $list .= '<li><strong>Phone:</strong> ' . $this->message['phone'] . '</li>';
        $list .= '</ul>';

        return (new MailMessage)
                    ->greeting('You have a new message.')
                    ->line($list)
                    ->line('Message:')
                    ->line(nl2br($this->message['message']))
                    ->success()
                    ->action('Watch now', url('/admin/messages'));
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
            //
        ];
    }
}
