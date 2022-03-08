<x-cms-layout>
    <livewire:datatable 
        name="all-questions"
        model="App\Models\Live\Question"
        with="category"
        include="id,label|question, category.name|sub-category"
        sort="created_at|desc"
        searchable="label"
        hide=""
        hideable="select"
        exportable
    />
</x-cms-layout>
