<?php

namespace App\Http\Livewire\Finance;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\WalletTransaction;

class TransactionTable extends DataTableComponent
{
    public string $primaryKey = 'id';

    public function columns(): array
    {
        return [
            Column::make("User", "wallets.id")
                ->searchable(),
            Column::make("Reference", "reference")
                ->searchable(),
            Column::make("Type", "transaction_type")
                ->sortable(),
            Column::make("Description", "description")
                ->searchable()
                ->sortable(),
            Column::make("Amount", "amount")
                ->sortable(),
            Column::make("Balance", "balance")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return WalletTransaction::query();
    }
}
