<div>
    <x-jet-nav-link>
        {{ __('Categories') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('cms.questions') }}" :active="request()->routeIs('cms.questions')">
        {{ __('Questions') }}
    </x-jet-nav-link>
</div>
