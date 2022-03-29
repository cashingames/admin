<x-finance-layout>
    @can('admin-access')
        <livewire:datatable 
        model="App\Models\Live\WalletTransaction" 
        name="all-transactions"
        include="reference, transaction_type | TYPE, description, amount, balance, created_at|Transaction Date"
        sort="created_at|desc"
        searchable="reference, description"
        />
    @else
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        You are not authorised to access this data.
    </div>
    @endcan
  
</x-finance-layout>
