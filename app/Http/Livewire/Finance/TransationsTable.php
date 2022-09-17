<?php

namespace App\Http\Livewire\Finance;

use App\Models\Live\User;
use App\Models\Live\WalletTransaction;
use App\Models\Live\Wallet;
use Illuminate\Support\Carbon;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;

class TransationsTable extends LivewireDatatable
{
    public function builder()
    {

        return WalletTransaction::query();
    }

    public function columns()
    {
        return
            [

                Column::callback(['wallet_id'], function ($wallet_id) {
                    $wallet = Wallet::find($wallet_id);
                    if (!is_null($wallet)) {
                        return User::find($wallet->user_id)->username;
                    }
                    return '';
                }, 'username')->label('Username'),

                Column::callback(['wallet_id'], function ($wallet_id) {
                    $wallet = Wallet::find($wallet_id);
                    if (!is_null($wallet)) {
                        return User::find($wallet->user_id)->email;
                    }
                    return '';
                }, 'email')->label('Email'),

                Column::callback(['wallet_id'], function ($wallet_id) {
                    $wallet = Wallet::find($wallet_id);
                    if (!is_null($wallet)) {
                        return User::find($wallet->user_id)->phone_number;
                    }
                    return '';
                }, 'phone')->label('Phone'),

                Column::name('reference')
                    ->label('Reference')
                    ->filterable()
                    ->searchable(),

                Column::name('transaction_type')
                    ->label('Type')
                    ->filterable()
                    ->searchable(),

                Column::name('description')
                    ->label('Description')
                    ->filterable()
                    ->searchable(),

                Column::name('amount')
                    ->label('Amount')
                    ->filterable()
                    ->searchable(),

                Column::name('balance')
                    ->label('Balance')
                    ->filterable()
                    ->searchable(),

                Column::callback(['created_at'], function ($created_at) {
                    return Carbon::parse($created_at)->setTimezone('Africa/Lagos');
                })->label('Transaction Date')->filterable(),

            ];
    }
}
