<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-end">
            <h2 class="text-sm text-default font-normal">My Projects</h2>
            <a href="/projects/create" class="text-default button">My Project</a>
        </div>
    </header>


    <div class="lg:flex flex-wrap -mx-3">
        @forelse($projects as $project)
        <div class="lg:w-1/3 px-3 pb-6">
            @include('projects.card')
        </div>
        @empty
        <div>No Projects Yet</div>
        @endforelse
    </div>

    <div x-data="{ open: false }">
        <button x-ref="modal1_button" @click="open = true" class="button">
            Open Modal
        </button>

        <div role="dialog" aria-labelledby="modal1_label" aria-modal="true" tabindex="0" x-show="open" @click="open = false; $refs.modal1_button.focus()" @click.away="open = false; $refs.modal1_button.focus()" class="fixed top-0 left-0 w-full h-screen flex justify-center items-center">
            <div class="absolute top-0 left-0 w-full h-screen bg-black opacity-60" aria-hidden="true" x-show="open"></div>
            <div @click.stop="" x-show="open" class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white w-3/5 h-3/5 z-10 p-10">
                    <h1 class="font-normal text-2xl mb-15 text-center pb-5" id="modal1_label">Let's Start Something Nnew</h1>
                <div class="flex">
                    <div class="flex-1 mr-4">
                        <div class="mb-4">
                            <label for="title" class="text-sm mb-2">Title</label>
                            <input type="text" id="title" class="border border-muted-light p-2 text-xs block w-full rounded" placeholder="Write a Title">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="text-sm mb-2">Description</label>
                            <textarea id="description" class="border border-muted-light p-2 text-xs block w-full rounded" rows="7" placeholder="Project Description"></textarea>
                        </div>
                    </div>
                    <div class="flex-1 ml-4">
                        <div class="mb-4">
                            <label for="title" class="text-sm mb-2">Need Some Tasks?</label>
                            <input type="text" id="title" class="border border-muted-light p-2 text-xs block w-full rounded" placeholder="Task 1">
                        </div>
                        <div class="inline-flex items-center">
                            <button class="mr-2">+</button>
                            <span class="text-xs">Add New Task Field</span>
                        </div>
                    </div>
                </div>

                <footer class="flex justify-end">
                    <button class="button mr-4">Create Project</button>
                    <buttom class="button">Cancel</buttom>
                </footer>
            </div>
        </div>
    </div>

</x-app-layout>
