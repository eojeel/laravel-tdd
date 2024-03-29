<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
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

        $attributes = Project::factory()->raw();

        $response = $this->followingRedirects()->post('/projects', $attributes);

        $response
            ->assertSee($attributes['title'])
            ->assertSee($attributes['notes'])
            ->assertSee($attributes['description']);
    }

    public function test_a_user_can_delete_a_project()
    {
        $this->signIn();

        $project = ProjectFactory::create();


        $this->ActingAs($project->owner)
        ->delete($project->path())
        ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));

    }

    public function test_a_guest_cannot_delete_a_project()
    {
        $project = ProjectFactory::create();

        $this->delete($project->path())
        ->assertRedirect('/login');

        $user = $this->signIn();

        $this->delete($project->path())->assertStatus(403);

        $project->invite($user);

        $this->actingAs($user)->delete($project->path())->assertStatus(403);

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

    public function test_a_user_can_update_a_projects_general_notes()
    {
        $project = ProjectFactory::create();

        $this->ActingAs($project->owner)
        ->patch($project->path(), $attributes = ['notes' => 'sosig']);

        $this->assertDatabaseHas('projects', $attributes);
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

    public function test_tasks_can_be_includeded_as_part_of_a_new_project()
    {
        $this->signIn();

        $attributes = Project::factory()->raw();

        $attributes['tasks'] = [
            ['body' => 'task 1'],
            ['body' => 'task 2']
        ];

        $this->post('/projects', $attributes);

        $this->assertCount(2, Project::first()->tasks);
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

    public function test_a_user_can_see_all_projects_they_have_been_invited_it()
    {

        $project = tap(ProjectFactory::create())->invite($this->signIn());

        $this->get('/projects')->assertSee($project->title);

    }
}
