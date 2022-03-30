<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight basis-1/4">
                {{ __('Manage Players') }}
            </h2>
        </div>
    </x-slot>
    @can('super-admin-access')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <livewire:datatable 
            name="all-users"
            model="App\Models\Live\User"
            with="profile"
            include="id, username, email, profile.first_name, profile.last_name, phone_number, profile.gender, profile.state, profile.referral_code, profile.account_name, profile.account_number, profile.bank_name, profile.referrer, created_at"
            sort="created_at|desc"
            searchable="username, email, phone_number, profile.referrer"
            hide="profile.gender, profile.state, profile.referral_code, profile.account_name, profile.account_number, profile.bank_name"
            hideable="select"
            exportable
        />
    </div>
    @else
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        You are not authorised to access this data.
    </div>
    @endcan
        
</x-app-layout>
