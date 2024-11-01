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
    public $complex = true;
    public $persistPerPage = false;
    public $persistHiddenColumns = false;
    public $defaultSortColumn = 'created_at';
    public $searchable = [
        'users.email', 'users.username', 'users.phone_number', 'reference', 'description',
        'users.phone_number'
    ];
    public $groupLabels = [
        'user' => 'TOGGLE USER DETAILS'
    ];

    public function builder()
    {
        return WalletTransaction::query()
            ->leftJoin('wallets', 'wallets.id', 'wallet_transactions.wallet_id')
            ->leftJoin('users', 'users.id', 'wallets.user_id')->where('wallets.user_id', '!=', 1);
    }

    public function columns()
    {
        return
            [
                Column::index($this),
                DateColumn::callback('created_at', function ($createdAt) {
                    return Carbon::parse($createdAt)->setTimezone('Africa/Lagos');
                })
                    ->label("Transaction Date")
                    ->filterable(),

                Column::name('reference')->hide(),
                Column::name('transaction_type')->filterable(['CREDIT', 'DEBIT']),
                Column::name('transaction_action')->filterable([
                    'BOOST_BOUGHT',
                    'WALLET_FUNDED',
                    'WINNINGS_CREDITED',
                    'WINNINGS_WITHDRAWN',
                    'STAKING_PLACED',
                    'BONUS_CREDITED',
                    'FUNDS_REVERSED',
                    'BONUS_TURNOVER_MIGRATED'
                ]),
                Column::name('description')->filterable([
                    'Cashdrop Lucky Winning',
                    'Challenge game Winnings credited',
                    'Challenge game stake debited',
                    'Challenge game stake refund',
                    'Successful Withdrawal',
                    'Wallet Top-up',
                    'Trivia challenge staking refund',
                    'Trivia challenge staking request',
                    'Trivia challenge staking winning'
                ]),

                NumberColumn::callback(['amount', 'transaction_type'], function ($amount, $transactionType) {
                    return $transactionType == 'CREDIT' ? $amount : -$amount;
                })->label('Amount')->filterable()->enableSummary(),

                NumberColumn::name('balance'),

                //@TODO Hide a group
                Column::name('users.username')->filterable()->group('user'),

                Column::name('users.email')->group('user'),

                Column::name('users.phone_number')->group('user'),

                DateColumn::name('users.created_at')->group('user')
                    ->label('Joined On')
                    ->filterable(),
            ];
    }
}
