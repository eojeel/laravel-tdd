<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-end">
            <p class="text-sm text-default font-normal">
                <a href="/projects" class="text-sm text-default font-normal no-underline">New Projects</a> /
                {{ $project->title }}
            </p>
            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img src="{{ gravatar_url($member->email) }}" a lt="{{ $member->name }}'s avatar"
                        class="rounded-full w-8 mr-2">
                @endforeach
                <img src="{{ gravatar_url($project->owner->email) }}" alt="{{ $project->owner->name }}'s avatar"
                    class="rounded-full w-8 mr-2">

                <a href="{{ $project->path() . '/edit' }}" class="text-default button ml-4">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-default text-sm font-normal text-lg">Tasks</h2>

                    @forelse($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{ $project->path() . '/tasks/' . $task->id }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input name="body" value="{{ $task->body }}"
                                        class="w-full  {{ $task->completed ? 'text-default' : ' ' }}">
                                    <input type="checkbox" name="completed" onchange="this.form.submit()"
                                        {{ $task->completed ? 'checked' : '' }}>
                                </div>
                            </form>
                        </div>
                    @empty
                        <div class="card text-default">No tasks yet</div>
                    @endforelse
                    <div class="card mb-3 text-default">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input type="text" name="body" class="w-full bg-card border-transparent" placeholder="Add a new task...">
                        </form>
                    </div>
                </div>
                <div class="mb-8">
                    <h2 class="text-default text-sm font-normal text-lg">General Notes</h2>
                    {{-- general notes --}}
                    <form action="{{ $project->path() }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <textarea name="notes" class="card w-full mb-4" style="min-height:200px" placeholder="Notes">{{ $project->notes }}</textarea>
                        <button class="button" type="submit">Save</button>
                    </form>

                    @include('errors')

                </div>
            </div>

            <div class="lg:w-1/4 px-3 lg:py-8">
                @include('projects.card')
                @include('projects.activity.card')

                @can ('manage', $project)
                    @include('projects.invite')
                @endcan

            </div>
        </div>
        </div>
    </main>



</x-app-layout>
