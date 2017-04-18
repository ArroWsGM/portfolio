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
        $email = $this->message->email ? '['. $this->message->email .'](mailto:' . $this->message->email . ')' : 'Not set';
        $phone = $this->message->phone ? $this->message->phone : 'Not set';

        return (new MailMessage)
                    ->replyTo($this->message->email, $this->message->name)
                    ->greeting('You have a new message.')
                    ->line('__From:__ ' . $this->message->name . '  ')
                    ->line('__Subject:__ ' . $this->message->subject . '  ')
                    ->line('__Email:__ ' . $email . '  ')
                    ->line('__Phone:__ ' . $phone . '  ')
                    ->line('Message:')
                    ->line($this->message->message)
                    ->success()
                    ->action('Watch now', url('/admin/messages/' . $this->message->id))
                    ->salutation('Buy.');
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
