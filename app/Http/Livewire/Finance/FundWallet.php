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
    public $message, $error, $bonuses, $notificationMessage;

    public function mount()
    {
        $this->username = '';
        $this->amount = 0;
        $this->walletType = '';
        $this->bonuses = Bonus::all();
        $this->notificationMessage = "Your wallet has been credited";
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

        if ($this->walletType == 'Fundable Wallet') {
            DB::transaction(function () use ($user) {

                $user->wallet->non_withdrawable += $this->amount;
                $user->wallet->save();

                WalletTransaction::create([
                    'wallet_id' => $user->wallet->id,
                    'transaction_type' => 'CREDIT',
                    'amount' => $this->amount,
                    'balance' => $user->wallet->non_withdrawable,
                    'description' => 'Wallet Top-up',
                    'reference' =>  Str::random(10),
                    'balance_type' => 'CREDIT_BALANCE',
                    'transaction_action' => 'WALLET_FUNDED'
                ]);
            });
        } elseif ($this->walletType == 'Bonus Wallet') {
            DB::transaction(function () use ($user) {
                $user->wallet->bonus += $this->amount;
                $user->wallet->save();
                
                WalletTransaction::create([
                    'wallet_id' => $user->wallet->id,
                    'transaction_type' => 'CREDIT',
                    'amount' => $this->amount,
                    'balance' => $user->wallet->bonus,
                    'description' => 'Bonus Top-up',
                    'reference' =>  Str::random(10),
                    'balance_type' => 'BONUS_BALANCE',
                    'transaction_action' => 'BONUS_CREDITED'
                ]);
            });
        } else {
            return $this->error = 'Invalid Wallet Type';
        }

        $this->message = 'Wallet funded';

        //database notification
        $user->notify(new WalletFunded($this->amount, $user, $this->notificationMessage));
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
