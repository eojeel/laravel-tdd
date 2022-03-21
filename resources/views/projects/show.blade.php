<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-end">
            <p class="text-sm text-slate-400 font-normal">
                <a href="/projects" class="text-sm text-slate-400 font-normal no-underline">My Projects</a> / {{ $project->title }}</p>
            <a href="/projects/create" class="text-slate-400 button">My Project</a>
        </div>
    </header>

    <main>
        <div class="flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-grey text-sm font-normal text-lg">Tasks</h2>

                    @forelse($project->tasks as $task)
                    <div class="card">{{ $task->body }}</div>
                    @empty
                    <div class="card">No tasks yet</div>
                    @endforelse
                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input type="text" name="body" class="w-full" placeholder="Add a new task...">
                    </div>
                </div>
                <div class="mb-8">
                    <h2 class="text-grey text-sm font-normal text-lg">General Notes</h2>
                    <textarea class="card w-full" style="min-height:200px">Lorem ipsum.</textarea>
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
                <div class="card">
                  @include('projects.card')
                </div>
            </div>
        </div>
    </main>



</x-app-layout>
