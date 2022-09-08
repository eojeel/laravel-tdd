<div class="card flex flex-col" style="height: 200px">
    <ul class="text-xs list-reset">
        @foreach($project->activity as $activity)
        <li class="{{ $loop->last ? '' : 'mb-1'}}">
            @include ("projects.activity.{$activity->description}")
            <span class="txt-gray">{{ $activity->created_at->diffForHumans(null, true) }}</span>
        </li>
        @endforeach
    </ul>
</div>
