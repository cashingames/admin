<x-gaming-layout>
    <livewire:datatable 
            name="all-users"
            model="App\Models\Live\GameSession"
            with="user, category, mode, plan"
            include="id,user.username,category.name|sub-category,mode.name|mode,plan.name|plan,points_gained|points,state,start_time,end_time"
            sort="start_time|desc"
            searchable="user.username"
            hide=""
            hideable="select"
            exportable
        />
</x-gaming-layout>
