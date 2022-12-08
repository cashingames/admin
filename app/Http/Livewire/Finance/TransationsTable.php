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
    public $complex = true;
    public $searchable = [
        'users.email', 'users.username', 'users.phone_number', 'reference', 'description',
        'users.phone_number'
    ];
    public $groupLabels = [
         'user' => 'TOGGLE USER DETAILS'
    ];
    public $defaultSortColumn = 'created_at';

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
                
                Column::name('users.username')->filterable()->group('user'),

                Column::name('users.email')->group('user'),

                Column::name('users.phone_number')->group('user'),

                Column::name('reference'),

                Column::name('description')->filterable([
                    'Fund Wallet',
                    'Sign Up Bonus',
                    'Winnings Withdrawal Made',
                    'Placed a staking',
                    'Bought TIME FREEZE boosts',
                    'Bought BOOST boosts',
                    'Bought BOMB boosts',
                ])->searchable(),

                Column::name('transaction_type')->filterable(['CREDIT', 'DEBIT']),

                NumberColumn::callback(['amount', 'transaction_type'], function ($amount, $transactionType) {
                    return $transactionType == 'CREDIT' ? $amount : -$amount;
                })->label('Amount')->filterable()->enableSummary(),

                NumberColumn::name('balance')->hide(),

                DateColumn::callback('created_at', function ($createdAt) {
                    return Carbon::parse($createdAt)->setTimezone('Africa/Lagos');
                })
                ->label("Transaction Date")
                ->filterable(),

            ];
    }
}
