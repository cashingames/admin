<?php

namespace App\Http\Livewire\Players;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use App\Models\Live\User;
use Mediconesystems\LivewireDatatables\DateColumn;

class UsersTable extends LivewireDatatable
{

    public $perPage = 100;
    public $persistPerPage = false;
    public $complex = true;

    public $searchable = [
        'users.email', 'users.username', 'users.phone_number',
        'profiles.first_name', 'profiles.last_name',
        'profiles.referrer', 'users.meta_data', 'users.last_activity_time',
        'users.phone_verified_at', 'users.email_verified_at', 'users.created_at'
    ];


    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');

        return User::query()
            ->select(
                "users.id",
                "users.created_at",
                "users.username",
                "users.email",
                "users.phone_number",
                "users.phone_verified_at",
                "users.email_verified_at",
                "users.last_activity_time",
                "users.brand_id as source",
                "profiles.first_name as first_name",
                "profiles.last_name as last_name",
                "profiles.gender as gender",
                "profiles.referral_code as referral_code",
                "profiles.referrer as referrer",
                "profiles.account_name as account_name",
                "profiles.account_number as account_number",
                "profiles.bank_name as bank_name",
                "profiles.state as state",
            )
            ->join("{$livedb}.profiles as profiles", "profiles.user_id", "=", "users.id");
    }


    public function columns()
    {
        return
            [
                Column::index($this),

                Column::callback(
                    ['id'],
                    function ($id) {
                        return view('components.users-table-actions', [
                            'id' => $id
                        ]);
                    },
                    ['actions']
                )->unsortable(),

                Column::name('profiles.first_name')
                    ->filterable()->searchable(),

                Column::name('profiles.last_name')
                    ->filterable()->searchable(),

                Column::name('username')
                    ->filterable()->searchable(),
                    
                Column::name("meta_data")
                    ->group('Tracking Data')
                    ->filterable()->searchable()
                    ->hide()
                    ->label('Tracking Data'),

                Column::name('last_activity_time')
                    ->filterable(),

                Column::name('email')
                    ->filterable(),

                Column::name('email_verified_at')
                    ->filterable(),

                Column::name('phone_number')
                    ->filterable(),

                Column::name('phone_verified_at')
                    ->filterable(),

                Column::name('profiles.referrer')
                    ->filterable(),

                DateColumn::name('created_at')
                    ->filterable()

            ];
    }
}
