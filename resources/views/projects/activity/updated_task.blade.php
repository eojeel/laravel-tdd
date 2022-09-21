@if (count($activity->changes['after']) == 1)
    {{ $activity->user->name }} updated the {{ key($activity->changes['after']) }} on of the tasks
@else
    {{ $activity->user->name }} updated the task
@endif
