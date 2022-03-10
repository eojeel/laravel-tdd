<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>


    <div class="flex">
    @forelse($projects as $project)
        <div class="bg-white mr-4 rounded shadow w-1/3 p-4" style="height:200px">
            <h3 class="font-normal text-xl py-4">{{ $project->title }}</h3>
            <div class="text-sm text-slate-400">{{ Str::limit($project->description, 100) }}</div>
        </div>
    @empty
        <div>No Projects Yet</div>
    @endforelse
    </div>

</x-app-layout>
