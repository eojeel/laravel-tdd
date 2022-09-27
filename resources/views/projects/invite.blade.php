<div class="card flex flex-col">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-sky-400 pl-4 flex1">
        Invite a User
    </h3>

    <form method="POST" action="{{ $project->path() . '/invitations' }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="border border-grey-light rounded w-full py-3 px-3"
                placeholder="Email Address">
        </div>
        <button class="button text-xs" type="submit">Invite</button>
        @include('errors', ['bag' => 'invitations'])
    </form>
</div>
