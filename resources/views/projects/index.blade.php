<x-app-layout>
    <x-slot name="header">
        <div class="flex items-centered">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="margin-right: auto;">
        Birdboard
        </h2>
        <a href="/projects/create">Create</a>
        </div>
    </x-slot>

    <ul>
        @foreach($projects as $project)
        <li>
            <a href="{{ $project->path() }}">{{ $project->title }}</a>
        </li>
        @endforeach
    </ul>
</x-app-layout>
