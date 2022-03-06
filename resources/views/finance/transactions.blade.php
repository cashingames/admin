<x-finance-layout>
    <livewire:datatable 
        model="App\Models\Live\WalletTransaction" 
        name="all-transactions"
        include="reference, transaction_type | TYPE, description, amount, balance, created_at|Transaction Date"
        sort="created_at|desc"
        searchable="reference, description"
    />
</x-finance-layout>
