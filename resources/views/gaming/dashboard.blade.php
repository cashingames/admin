<x-gaming-layout>
@canany(['super-admin-access','view-only-access'])
   <div>
      <livewire:gaming.reports />
   </div>
   @else
   You are not authorised to access this data.

   @endcanany

</x-gaming-layout>