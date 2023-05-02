<x-cms-layout>
  @if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'cms:view') )
  <livewire:cms.upload-questions />
  @else
  <p>You are not authorized to access this data</p>
  @endif
</x-cms-layout>