<?php

namespace App\Http\Livewire\Players;


use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;

class UsersTable extends LivewireDatatable
{

    public function builder()
    {
        $livedb = config('database.connections.mysqllive.database');

        $query = User::query()
            ->select(
                "users.id",
                "users.created_at",
                "users.username",
                "users.email",
                "users.phone_number",
                "users.phone_verified_at",
                "users.email_verified_at",
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

        return $query;
    }


    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),

                Column::name('profiles.first_name')
                ->label('First Name')
                ->filterable()
                ->searchable(),

                Column::name('profiles.last_name')
                ->label('Last Name')
                ->filterable()
                ->searchable(),

                Column::name('username')
                    ->searchable()
                    ->filterable(),

                Column::name('email')
                    ->label('Email')
                    ->filterable()
                    ->searchable(),

                Column::name('email_verified_at')
                    ->label('Email Verified At')
                    ->searchable()
                    ->filterable(),

                Column::name('phone_number')
                    ->label('Phone Number')
                    ->filterable()
                    ->searchable(),

                Column::name('phone_verified_at')
                    ->label('Phone Verified At')
                    ->searchable()
                    ->filterable(),

                Column::name('profiles.gender')
                ->label('Gender')
                ->filterable()
                ->searchable(),
                
                Column::name('profiles.referral_code')
                ->label('Referral Code')
                ->filterable()
                ->searchable(),

                Column::name('profiles.account_name')
                ->label('Account Name')
                ->filterable()
                ->searchable(),

                Column::name('profiles.bank_name')
                ->label('Bank Name')
                ->filterable()
                ->searchable(),

                Column::name('profiles.account_number')
                ->label('Account Number')
                ->filterable()
                ->searchable(),

                Column::name('profiles.state')
                ->label('State')
                ->filterable()
                ->searchable(),

                Column::name('profiles.referrer')
                ->label('Referrer')
                ->filterable()
                ->searchable(),

                Column::name('created_at')
                    ->searchable()
                    ->filterable()

            ];
    }
}
