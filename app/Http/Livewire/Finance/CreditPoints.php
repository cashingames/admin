<?php

namespace App\Http\Livewire\Finance;

use App\Actions\PushNotifications\SendPushNotification;
use App\Models\Live\User;
use App\Models\Live\UserPoint;
use App\Notifications\PointsCredited;
use Livewire\Component;

class CreditPoints extends Component
{
    public $username, $points;
    public $message, $error;

    public function mount()
    {
        $this->username = '';
        $this->points = 0;
    }

    public function updated()
    {
        $this->error = '';
        $this->message = '';
    }

    public function creditPoints()
    {
        $user = User::where('username', $this->username)->first();

        if (is_null($user)) {
            return $this->error = 'Username does not exist';
        }

        UserPoint::create([
            'user_id' => $user->id,
            'value' => $this->points,
            'description' => "Points Credited From Admin",
            'point_flow_type' => 'POINTS_ADDED'
        ]);

        $this->message = 'Points Credited';

        //database notification
        $user->notify(new PointsCredited($this->points, $user));
        $user->notifications()->where('notifiable_type', 'App\Models\Live\User')->update([
            'notifiable_type' => 'App\Models\User'
        ]);

        //push notification
        dispatch(function () use ($user) {
            $pushAction = new SendPushNotification();
            $pushAction->sendPointsCreditedNotification($user, $this->points);
        });
    }

    public function render()
    {
        return view('livewire.finance.credit-points');
    }
}
