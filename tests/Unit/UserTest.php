<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_projects()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    public function test_a_user_has_accesable_projects()
    {

        $john = $this->signIn();

        $project = ProjectFactory::ownedBy($john)->Create();

        $this->assertCount(1, $john->accessibleProjects());

        $sally = User::factory()->create();

        $project = ProjectFactory::ownedBy($sally)->Create()->invites($john);

        $this->assertCount(2, $john->accessibleProjects());

    }
}
