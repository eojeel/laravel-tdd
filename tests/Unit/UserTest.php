<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Facades\Tests\Setup\ProjectFactory;
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

        ProjectFactory::ownedBy($john)->Create();

        $this->assertCount(1, $john->accessibleProjects());

        $sally = User::factory()->create();
        $nick = User::factory()->create();

        $sallyProject = tap(ProjectFactory::ownedBy($sally)->Create())->invite($nick);

        $this->assertCount(1, $john->accessibleProjects());

        $sallyProject->invite($john);

        $this->assertCount(2, $john->accessibleProjects());


    }
}
