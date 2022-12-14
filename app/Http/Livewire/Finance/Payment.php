<?php

namespace App\Http\Livewire\Finance;

use App\Models\Live\User;
use App\Models\Live\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class Payment extends Component
{   
    public $username, $amount, $walletType;
    public $message, $error, $user;

    public function mount(){
        $this->username = '';
        $this->amount = 0;
        $this->walletType = 'Platform Account';
        $this->user = User::where('username',$this->username)->first();
    }

    public function updated(){
        $this->error = '';
        $this->message = '';
    }

    public function fund(){
    
        if(is_null($this->user)){
           return $this->error = 'Username does not exist';
        }

        DB::transaction(function ()  {
            $this->user->wallet->non_withdrawable_balance += $this->amount;
            $this->user->wallet->save();

            WalletTransaction::create([
                'wallet_id' => $this->user->wallet->id,
                'transaction_type' => 'CREDIT',
                'amount' => $this->amount,
                'balance' => $this->user->wallet->non_withdrawable_balance,
                'description' => 'Fund Wallet',
                'reference' =>  Str::random(10),
            ]);
           
        });

        $this->message = 'Wallet funded';


    }

    public function render()
    {
        return view('livewire.finance.payment');
    }
}
