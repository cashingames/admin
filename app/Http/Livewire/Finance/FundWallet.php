<?php

namespace App\Http\Livewire\Finance;

use App\Models\Live\User;
use App\Models\Live\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class FundWallet extends Component
{   
    public $username, $amount, $walletType;
    public $message, $error;

    public function mount(){
        $this->username = '';
        $this->amount = 0;
        $this->walletType = 'Platform Account';
       
    }

    public function updated(){
        $this->error = '';
        $this->message = '';
    }

    public function fund(){
        $user = User::where('username',$this->username)->first();

        if(is_null($user)){
           return $this->error = 'Username does not exist';
        }

        DB::transaction(function () use ($user)  {
            $user->wallet->non_withdrawable_balance += $this->amount;
            $user->wallet->save();

            WalletTransaction::create([
                'wallet_id' => $user->wallet->id,
                'transaction_type' => 'CREDIT',
                'amount' => $this->amount,
                'balance' => $user->wallet->non_withdrawable_balance,
                'description' => 'Fund Wallet',
                'reference' =>  Str::random(10),
            ]);
           
        });

        $this->message = 'Wallet funded';
    }

    public function render()
    {
        return view('livewire.finance.fund-wallet');
    }
}
