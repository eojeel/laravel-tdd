@if ($errors->{$bag ?? 'default'}->any())
    <ul class="field mt-6 list-reset">
        @foreach ($errors->invitations->all() as $error)
            <li class="text-sm text-red">{{ $error }}</li>
        @endforeach
    </ul>
@endif
