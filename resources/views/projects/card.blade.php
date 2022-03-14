<h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-sky-400 pl-4">
    <a href="{{ $project->path() }}">{{ $project->title }}</a>
</h3>
<div class="text-sm text-slate-400">{{ Str::limit($project->description, 100) }}</div>
