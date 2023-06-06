<?php

namespace App\Http\Livewire\Players;

use App\Enums\PlatformType;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;
use Mediconesystems\LivewireDatatables\DateColumn;

class UsersTable extends LivewireDatatable
{

    public $perPage = 100;
    public $persistPerPage = false;
    public $complex = true;

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

                Column::name('profiles.first_name')
                    ->filterable()
                    ->searchable(),

                Column::name('profiles.last_name')
                    ->filterable()
                    ->searchable(),

                Column::name('username')
                    ->searchable()
                    ->filterable(),

                // Column::name('brand_id')
                //     ->searchable()
                //     ->filterable()->label('Source ID'),

                // Column::callback(['brand_id'], function ($brand_id) {
                //     $brand = '';
                //     if($brand_id == 1) {
                //         $brand = PlatformType::V1->value ;
                //     }
                //     if($brand_id == 2){
                //         $brand = PlatformType::Cashingames->value;
                //     }
                //     if($brand_id == 10){
                //         $brand = PlatformType::GameArk->value ;
                //     }
                //     return $brand;
                // })->label('Source'),

                Column::name('last_activity_time')
                    ->searchable()
                    ->filterable(),

                Column::name('email')
                    ->filterable()
                    ->searchable(),

                Column::name('email_verified_at')
                    ->searchable()
                    ->filterable(),

                Column::name('phone_number')
                    ->filterable()
                    ->searchable(),

                Column::name('phone_verified_at')
                    ->searchable()
                    ->filterable(),

                Column::name('profiles.referrer')
                    ->filterable()
                    ->searchable(),

                DateColumn::name('created_at')
                    ->searchable()
                    ->filterable()

            ];
    }
}
