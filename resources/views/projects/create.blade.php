<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create
        </h2>
    </x-slot>


    <form method="POST" action="/projects">
        @csrf
        <div class="field">
            <label class="label" for="title">Title</label>
            <div class="control">
                <input class="input" type="text" name="title" id="title" value="{{ old('title') }}">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>
            <div class="control">
                <textarea class="textarea" name="description" id="description">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
                <a href="/projects" class="button is-link">Cancel</a>
            </div>
        </div>

</x-app-layout>
