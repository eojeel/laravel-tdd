<div class="card flex flex-col text-default" style="height: 200px">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-sky-400 pl-4 flex1">
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>
    <div class="text-sm text-default mb-4 flex1">{{ Str::limit($project->description, 100) }}</div>

    <footer>

    @can('manage', $project)
        <form method="POST" action="{{ $project->path() }}" class="text-right text-default">
            @csrf
            @method('DELETE')
            <button class="button text-xs" type="submit">Delete</button>
        </form>
    @endcan
    </footer>
</div>
