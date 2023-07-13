<?php

namespace App\Http\Livewire\Finance;

use App\Models\Live\UserBonus;
use App\Models\Live\Bonus;
use Illuminate\Support\Carbon;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserBonusesTable extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';
    public $complex = true;
    public $persistPerPage = false;
    public $persistHiddenColumns = false;
    public $searchable = [
        'users.email', 'users.username', 'users.phone_number'
    ];
    public $groupLabels = [
        'user' => 'TOGGLE USER DETAILS'
    ];

    public function builder()
    {
        return UserBonus::query()
            ->join('users', 'users.id', 'user_bonuses.user_id')
            ->join('bonuses','bonuses.id', 'user_bonuses.bonus_id');
    }

    public function columns()
    {
        return
            [
                Column::index($this),

                Column::name('users.username')->filterable()->group('user'),

                Column::name('users.email')->group('user')->hide(),

                Column::name('users.phone_number')->group('user'),

                Column::name('bonus.name')->label('Bonus Type')->filterable()->searchable(),

                NumberColumn::name('amount_credited')->label('Bonus Amount Credited')->filterable(),

                NumberColumn::name('total_amount_won')->label('Total Amount Rolled Over')->filterable(),

                BooleanColumn::name('is_on')->label('Is Active')->filterable(),

                DateColumn::callback('updated_at', function ($updatedAt) {
                    return Carbon::parse($updatedAt)->setTimezone('Africa/Lagos');
                })->label('Last Activity')->filterable(),

                DateColumn::callback('created_at', function ($createdAt) {
                    return Carbon::parse($createdAt)->setTimezone('Africa/Lagos');
                })->label('Date Credited')->filterable(),


            ];
    }
}
