<?php

namespace App\Http\Livewire\Finance;

use App\Actions\PushNotifications\SendPushNotification;
use App\Models\Live\Bonus;
use App\Models\Live\User;
use App\Models\Live\WalletTransaction;
use App\Notifications\WalletFunded;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class FundWallet extends Component
{
    public $username, $amount, $walletType, $bonusType;
    public $message, $error, $bonuses;

    public function mount()
    {
        $this->username = '';
        $this->amount = 0;
        $this->walletType = 'Fundable Wallet';
        $this->bonuses = Bonus::all();
    }

    public function updated()
    {
        $this->error = '';
        $this->message = '';
    }

    public function fund()
    {
        $user = User::where('username', $this->username)->first();

        if (is_null($user)) {
            return $this->error = 'Username does not exist';
        }

        DB::transaction(function () use ($user) {

            if ($this->walletType == 'Fundable Wallet') {
                $user->wallet->non_withdrawable += $this->amount;
            } else {
                $user->wallet->bonus += $this->amount;
            }

            $user->wallet->save();

            WalletTransaction::create([
                'wallet_id' => $user->wallet->id,
                'transaction_type' => 'CREDIT',
                'amount' => $this->amount,
                'balance' => ($this->walletType == 'Fundable Wallet' ? $user->wallet->non_withdrawable : $user->wallet->bonus),
                'description' => ($this->walletType == 'Fundable Wallet' ? 'Wallet Top-up' : 'Bonus Top-up'),
                'reference' =>  Str::random(10),
                'balance_type' => ($this->walletType == 'Fundable Wallet' ? 'CREDIT_BALANCE' : 'BONUS_BALANCE'),
                'transaction_action' => ($this->walletType == 'Fundable Wallet' ? 'WALLET_FUNDED' : 'BONUS_CREDITED')
            ]);
        });

        $this->message = 'Wallet funded';

        //database notification
        $user->notify(new WalletFunded($this->amount, $user));
        $user->notifications()->where('notifiable_type', 'App\Models\Live\User')->update([
            'notifiable_type' => 'App\Models\User'
        ]);

        //push notification
        dispatch(function () use ($user) {
            $pushAction = new SendPushNotification();
            $pushAction->sendWalletFundedNotification($user, $this->amount);
        });
    }

    public function render()
    {
        return view('livewire.finance.fund-wallet');
    }
}
