<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-center">
        <h2 class="text-sm text-slate-400 font-normal">My Projects</h2>
       <a href="/projects/create" class="text-slate-400 button">My Project</a>
        </div>
</header>


    <div class="lg:flex flex-wrap -mx-3">
    @forelse($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6">
        <div class="bg-white rounded-lg shadow p-5" style="height:200px">
            <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-sky-400 pl-4">
                <a href="{{ $project->path() }}">{{ $project->title }}</a>
            </h3>
            <div class="text-sm text-slate-400">{{ Str::limit($project->description, 100) }}</div>
        </div>
    </div>
    @empty
        <div>No Projects Yet</div>
    @endforelse
    </div>

</x-app-layout>
