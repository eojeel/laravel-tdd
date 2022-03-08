<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $attributes = [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph()
        ];

        $this->post('/projects', $attributes);

        $this->assertDatabaseHas('projects', $attributes);
    }

    public function test_a_project_requires_a_title()
    {
        $this->actingAs(User::factory()->create());
        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_only_authenticated_users_can_create_projects()
    {
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    public function test_a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())
        ->assertSee($project->id)
        ->assertSee($project->title);
    }
}
