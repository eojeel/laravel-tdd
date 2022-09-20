<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="lg:w-1/3 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow content-center">

        <form method="POST" action="{{ $project->path() }}">

            <h2 class="text-2xl font-normal mb-10 text-center">
                Edit your project
            </h2>

            @method('PATCH')

            @include ('projects.form', [
            'buttonText' => 'Update Project'
            ])


    </div>

 </x-app-layout>
