<x-cms-layout>
  @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'cms:view') )
  <livewire:cms.reports />
  @else
  <p>You are not authorized to access this data</p>
  @endif
</x-cms-layout>