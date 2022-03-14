<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-end">
        <h2 class="text-sm text-slate-400 font-normal">My Projects</h2>
       <a href="/projects/create" class="text-slate-400 button">My Project</a>
        </div>
</header>


    <div class="lg:flex flex-wrap -mx-3">
    @forelse($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6">
        <div class="card" style="height:200px">
        @include('projects.card')
        </div>
    </div>
    @empty
        <div>No Projects Yet</div>
    @endforelse
    </div>

</x-app-layout>
