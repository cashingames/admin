<x-gaming-layout>
   @can('super-admin-access')
   <div>
      <livewire:gaming.reports />
   </div>
   @else
   You are not authorised to access this data.

   @endcan

</x-gaming-layout>