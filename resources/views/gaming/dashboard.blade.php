<x-gaming-layout>
   @can('super-admin-access')
   Dashboard
   @else
   You are not authorised to access this data.

   @endcan

</x-gaming-layout>