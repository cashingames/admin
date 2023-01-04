<?php

namespace App\Notifications;

use App\Enums\PushNotificationType;
use App\Models\Live\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WalletFunded extends Notification
{
    use Queueable;


    public $amount;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount, User $user)
    {
        $this->amount = $amount;
        $this->user = $user;
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
            'title' => "Your wallet has been credited with #{$this->amount} naira",
            'action_type' => PushNotificationType::Wallet,
            'action_id' => $this->user->wallet->id
        ];
    }
}
