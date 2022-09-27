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

    public function test_non_owner_may_not_invite_users()
    {
        $project = ProjectFactory::create();

        $user = User::factory()->create();

        $this->actingAs($user)
        ->post($project->path().'/invitations')
        ->assertStatus(403);
    }

    public function test_the_invite_email_address_must_be_a_valid_account()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
        ->post($project->path().'/invitations', [
            'email' => 'notauser@example.com'
        ])->assertSessionHasErrors('email');

    }

    public function test_a_project_can_invite_a_user()
    {

        $project = ProjectFactory::create();

        $userToInvite = User::factory()->create();

        $this->actingAs($project->owner)->post($project->path().'/invitations', [
            'email' => $userToInvite->email
        ]);

        $this->assertTrue($project->members->contains($userToInvite));

    }

    public function test_a_project_can_update_a_project_detail()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = User::Factory()->create());

        $this->signIn($newUser);

        $this->post(action([ProjectsTaskController::class, 'store'], [$project]), $task = ['body' => 'Foo Task']);

        $this->assertDatabaseHas('tasks', $task);

    }

}
