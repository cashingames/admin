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
                'body' => "Your wallet has been credited with #{$amount} naira "
            ]
        )
            ->setData(
                [

                    'title' => "Credit Alert! : Your wallet has just been credited.",
                    'body' => "Your wallet has been credited with #{$amount} naira ",
                    'action_type' => PushNotificationType::Wallet,
                    'action_id' => $user->wallet->id,
                    'unread_notifications_count' => $user->unreadNotifications()->count()

                ]
            )
            ->setTo($recipient->device_token)
            ->send();
        Log::info("Wallet fund notification sent to: " . $user->username);
    }
}
