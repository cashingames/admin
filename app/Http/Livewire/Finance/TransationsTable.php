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
    // public $model = WalletTransaction::class;
    // public $hideable = 'select';
    // public $exportable = true;
    // public $complex = true;
    // public $hide = ['id', 'user_id', 'wallet_id', 'created_at', 'updated_at', 'deleted_at'];
    // public $dateRange = true;
    // public $dateRangeFormat = 'Y-m-d';
    // public $dateRangeLabels = ['From', 'To'];
    // public $dateRangeDefault = [Carbon::now()->subDays(30)->format('Y-m-d'), Carbon::now()->format('Y-m-d')];
    public $perPage = 25;
    // public $search = '';
    // public $sortField = 'created_at';
    // public $sortAsc = false;
    // public $showFilters = true;
    // public $showPerPage = true;
    // public $showExport = true;
    // public $showTableActions = true;
    // public $showSearch = true;
    // public $showPagination = true;
    // public $showPageStats = true;
    // public $showColumnSearch = true;
    // public $showColumnFilters = true;
    // public $showColumnSort = true;
    // public $showDateRange = true;
    // public $showText = 'Show';
    // public $hideText = 'Hide';
    // public $exportText = 'Export';
    // public $exportAllText = 'Export All';
    // public $clearFilterText = 'Clear Filter';
    // public $clearAllFilterText = 'Clear All Filter';
    // public $applyFilterText = 'Apply Filter';
    // public $applyBulkActionText = 'Apply';
    // public $exportFileName = 'transactions';
    // public $exportHeading = 'Transactions';
    // public $exportFormats = ['csv', 'xlsx', 'pdf'];
    // public $exportBeforeCallback = null;
    // public $exportAfterCallback = null;
    // public $exportCallback = null;
    // public $exportAllBeforeCallback = null;
    // public $exportAllAfterCallback = null;
    // public $exportAllCallback = null;
    // public $exportView = 'livewire-datatables::exports.export';
    // public $exportAllView = 'livewire-datatables::exports.export-all';
    // public $exportAllHeading = 'Transactions';
    // public $exportAllFileName = 'transactions';
    // public $exportAllFormats = ['csv', 'xlsx', 'pdf'];
    

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

                Column::name('users.username'),

                Column::name('users.email'),

                Column::name('users.phone_number'),

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
