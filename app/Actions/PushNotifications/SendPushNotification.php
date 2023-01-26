<?php

namespace App\Actions\PushNotifications;

use App\Enums\PushNotificationType;
use App\Models\Live\FcmPushSubscription as LiveFcmPushSubscription;
use App\Models\Live\User;
use App\Services\CloudMessagingService;
use Illuminate\Support\Facades\Log;

class SendPushNotification
{
    /**
     * @var App\Services\Firebase\CloudMessaging
     */
    public $pushService;

    public function __construct()
    {
        $this->pushService = new CloudMessagingService(config('services.firebase.server_key'));
    }

    public function sendWalletFundedNotification(User $user, $amount)
    {
        $recipient = LiveFcmPushSubscription::where('user_id', $user->id)->latest()->first();
        if (is_null($recipient)) {
            return;
        }
        $this->pushService->setNotification(
            [
                'title' => "Credit Alert! : Your wallet has just been credited.",
                'body' => "Your wallet has been credited with ₦{$amount}"
            ]
        )
            ->setData(
                [

                    'title' => "Credit Alert! : Your wallet has just been credited.",
                    'body' => "Your wallet has been credited with ₦{$amount}",
                    'action_type' => PushNotificationType::Wallet,
                    'action_id' => $user->wallet->id,
                    'unread_notifications_count' => $user->unreadNotifications()->count()

                ]
            )
            ->setTo($recipient->device_token)
            ->send();
        Log::info("Wallet fund notification sent to: " . $user->username);
    }

    public function sendPointsCreditedNotification(User $user, $points)
    {
        $recipient = LiveFcmPushSubscription::where('user_id', $user->id)->latest()->first();
        if (is_null($recipient)) {
            return;
        }
        $this->pushService->setNotification(
            [
                'title' => "Points Credited! : You have just been credited with points.",
                'body' => "You have just been credited with {$points} points "
            ]
        )
            ->setData(
                [

                    'title' => "Points Credited! : You have just been credited with points.",
                    'body' => "You have just been credited with {$points} points ",
                    'action_type' => PushNotificationType::Points,
                    'action_id' => $user->id,
                    'unread_notifications_count' => $user->unreadNotifications()->count()

                ]
            )
            ->setTo($recipient->device_token)
            ->send();
        Log::info("Points Credit notification sent to: " . $user->username);
    }
}
