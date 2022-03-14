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
                    <div class="card">Lorem ipsum.</div>
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
