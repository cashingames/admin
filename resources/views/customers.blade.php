<x-customers-layout>
    @can('super-admin-access')
   
        <livewire:datatable 
            name="all-users"
            model="App\Models\Live\User"
            with="profile"
            include="id, username, email, profile.first_name, profile.last_name, phone_number, profile.gender, profile.state, profile.referral_code, profile.account_name, profile.account_number, profile.bank_name, profile.referrer, created_at"
            sort="created_at|desc"
            searchable="profile.first_name, profile.last_name, username, email, phone_number, profile.referrer"
            hide="profile.gender, profile.state, profile.referral_code, profile.account_name, profile.account_number, profile.bank_name"
            hideable="select"
            exportable
        />
   
    @else
        You are not authorised to access this data.
   
    @endcan
        
</x-customers-layout>
