<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Facades\Tests\Setup\ProjectFactory;
use App\Http\Controllers\ProjectsTaskController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = User::Factory()->create());

        $this->signIn($newUser);

        $this->post(action([ProjectsTaskController::class, 'store'], [$project]), $task = ['body' => 'Foo Task']);

        $this->assertDatabaseHas('tasks', $task);

    }


}
