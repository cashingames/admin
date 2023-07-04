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

                Column::name('meta_data->device_brand')
                    ->group('Tracking Data')
                    ->hide()
                    ->label('Device Brand'),

                Column::name('meta_data->device_model')
                    ->group('Tracking Data')
                    ->hide()
                    ->label('Device Model'),

                Column::name('meta_data->device_token')
                    ->group('Tracking Data')
                    ->hide()
                    ->label('Device Token'),

                Column::name('meta_data->registration_ip_address')
                    ->group('Tracking Data')
                    ->hide()
                    ->label('Registration IP'),
               
                Column::name('meta_data->login_ip_address')
                    ->group('Tracking Data')
                    ->hide()
                    ->label('Login IP'),

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

                Column::name('profiles.referral_code')
                    ->filterable()
                    ->searchable(),

                Column::name('profiles.referrer')
                    ->filterable()
                    ->searchable(),

                DateColumn::name('created_at')
                    ->searchable()
                    ->filterable()

            ];
    }
}
