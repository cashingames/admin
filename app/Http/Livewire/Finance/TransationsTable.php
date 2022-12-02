<?php

namespace App\Http\Livewire\Finance;

use App\Models\Live\User;
use App\Models\Live\WalletTransaction;
use App\Models\Live\Wallet;
use Illuminate\Support\Carbon;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TransationsTable extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';
    public $hide = ['balance'];
    public $groupLabels = [
         'user' => 'TOGGLE USER DETAILS'
    ];
    public $complex = true;

    public function builder()
    {
        return WalletTransaction::query()
            ->leftJoin('wallets', 'wallets.id', 'wallet_transactions.wallet_id')
            ->leftJoin('users', 'users.id', 'wallets.user_id');
    }

    public function columns()
    {
        return
            [
                Column::index($this),
                
                Column::name('users.username')->group('user'),

                Column::name('users.email')->group('user'),

                Column::name('users.phone_number')->group('user'),

                Column::name('reference')->searchable(),

                Column::name('description')->filterable([
                    'Fund Wallet',
                    'Sign Up Bonus',
                    'Winnings Withdrawal Made',
                    'Placed a staking'
                ])->searchable(),

                Column::name('transaction_type')->filterable(['CREDIT', 'DEBIT']),

                NumberColumn::name('amount'),

                NumberColumn::name('balance')->hide(),

                DateColumn::callback('created_at', function ($createdAt) {
                    return Carbon::parse($createdAt)->setTimezone('Africa/Lagos');
                })
                ->label("Transaction Date")
                ->filterable(),

            ];
    }
}
