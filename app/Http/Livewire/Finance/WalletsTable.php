<?php

namespace App\Http\Livewire\Finance;

use App\Models\Live\Wallet;
use Illuminate\Support\Carbon;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class WalletsTable extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';
    public $complex = true;
    public $persistPerPage = false;
    public $perPage = 100;
    public $persistHiddenColumns = false;
    public $defaultSortColumn = 'created_at';
    public $searchable = [
        'users.email', 'users.username', 'users.phone_number'
    ];
    public $groupLabels = [
        'user' => 'TOGGLE USER DETAILS'
    ];

    public function builder()
    {
        return Wallet::query()
            ->join('users', 'users.id', 'wallets.user_id');
    }

    public function columns()
    {
        return
            [
                Column::index($this),

                Column::name('users.username')->filterable()->group('user'),

                Column::name('users.email')->group('user'),

                Column::name('users.phone_number')->group('user'),

                NumberColumn::name('non_withdrawable_balance')->label('Platform Balance'),

                NumberColumn::name('withdrawable_balance')->label('Earnings Balance'),

                DateColumn::callback('created_at', function ($createdAt) {
                    return Carbon::parse($createdAt)->setTimezone('Africa/Lagos');
                })->filterable(),

                DateColumn::callback('updated_at', function ($updatedAt) {
                    return Carbon::parse($updatedAt)->setTimezone('Africa/Lagos');
                })->filterable(),


            ];
    }
}
