<x-finance-layout>
    @can('super-admin-access')
    <div class="pt-8">
        <livewire:finance.transations-table  />
    </div>
    @else
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        You are not authorised to access this data.
    </div>
    @endcan

</x-finance-layout>