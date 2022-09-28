<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-default leading-tight">
            Create
        </h2>
    </x-slot>

    <div class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">
        <form method="POST" action="/projects">


            <h2 class="text-2xl font-normal mb-10 text-center">
                Create a new Project
            </h2>
            @include ('projects.form', [
            'project' => new App\Models\Project,
            'buttonText' => 'Create Project'
            ])

        </form>
    </div>

</x-app-layout>
