<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-end">
            <h2 class="text-sm text-default font-normal">My Projects</h2>
               <div x-data="{ open: false }">
                    <button x-ref="modal1_button" @click="open = true" class="text-default button">
                        new Project
                    </button>
                    @include('modal')
                </div>
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



</x-app-layout>
