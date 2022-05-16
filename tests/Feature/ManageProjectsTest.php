<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    public function test_guests_cannot_manage_projects()
    {
        $project = Project::factory()->create();

        $this->get('/projects/create')->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get('/projects')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

    public function test_a_user_can_create_a_project()
    {
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'notes' => 'General notes'
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['notes'])
            ->assertSee($attributes['description']);
    }


    public function test_a_user_can_update_a_project()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->ActingAs($project->owner)
        ->patch($project->path(), $attributes = ['title' => 'changed', 'description' => 'changed', 'notes' => 'changed'])
        ->assertRedirect($project->path());

        $this->get($project->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('projects', [
            $attributes
        ]);
    }


    public function test_a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_only_authenticated_users_can_create_projects()
    {
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    public function test_a_user_can_view_their_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
        ->get($project->path())
        ->assertSee($project->id)
        ->assertSee($project->title);
    }

    public function test_an_authenticated_user_cannot_view_the_projectes_from_others()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_an_authenticated_user_cannot_update_the_projectes_from_others()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->patch($project->path(), [])->assertStatus(403);
    }
}
