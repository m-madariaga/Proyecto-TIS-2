<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class lowStockNotif extends Notification
{
    use Queueable;

    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // This will be sent in mail notification
        return (new MailMessage)
                    ->greeting("Advertencia")
                    ->line("El stock del producto {$this->name} es bajo.")
                    ->line("Se recomienda conseguir más stock.");
    }

    public function toDatabase($notifiable) {
        // This will be stored in Database, You'll fetch this notification later to display in application
        return [
            'body' => 'Advertencia, el stock del producto '.$this->name.' es bajo.',
        ];
    }
}
