<?php

namespace App\Http\Livewire\Players;


use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Live\User;
use App\Models\Live\Profile;

class UsersTable extends LivewireDatatable
{

    public function builder()
    {

        return User::query();
    }


    public function columns()
    {
        return
            [
                NumberColumn::name('id')
                    ->label('ID'),
                Column::callback(['id'], function ($id) {
                    $profile = Profile::where('user_id', $id)->first();
                    return $profile->first_name;
                }, 'first_name')->label('First Name'),

                Column::callback(['id'], function ($id) {
                    $profile = Profile::where('user_id', $id)->first();
                    return $profile->last_name;
                }, 'last_name')->label('Last Name'),

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

                Column::callback(['id'], function ($id) {
                    $profile = Profile::where('user_id', $id)->first();
                    return $profile->gender;
                }, 'gender')->label('Gender'),

                Column::callback(['id'], function ($id) {
                    $profile = Profile::where('user_id', $id)->first();
                    return $profile->referral_code;
                }, 'referral_code')->label('Referral Code'),

                Column::callback(['id'], function ($id) {
                    $profile = Profile::where('user_id', $id)->first();
                    return $profile->account_name;
                }, 'account_name')->label('Account Name'),

                Column::callback(['id'], function ($id) {
                    $profile = Profile::where('user_id', $id)->first();
                    return $profile->bank_name;
                }, 'bank_name')->label('Bank Name'),

                Column::callback(['id'], function ($id) {
                    $profile = Profile::where('user_id', $id)->first();
                    return $profile->account_number;
                }, 'account_number')->label('Account Number'),

                Column::callback(['id'], function ($id) {
                    $profile = Profile::where('user_id', $id)->first();
                    return $profile->state;
                }, 'state')->label('State'),

                Column::callback(['id'], function ($id) {
                    $profile = Profile::where('user_id', $id)->first();
                    return $profile->referrer;
                }, 'referrer')->label('Referrer'),

                Column::callback(['id'], function ($id) {
                   return User::find($id)->gameSessions()->count();
                }, 'game_count')->label('Game Count'),

                Column::callback(['id'], function ($id) {
                    return User::find($id)->gameSessions()->latest()->get('updated_at');
                 }, 'last_played')->label('Date Of Last Game'),

                Column::name('created_at')
                    ->searchable()
                    ->filterable()

            ];
    }
}
