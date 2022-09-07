<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    function test_creating_a_project_records_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1 ,$project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    function test_updating_a_project_records_acitivity()
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'Changed']);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);

    }

    function test_creating_a_new_task_records_project_acitivity()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $project->addTask('Some Task');

        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }

    function test_completing_a_new_task_records_project_acitivity()
    {

        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true
            ]);

        $this->assertCount(3, $project->activity);
        $this->assertEquals('completed_task', $project->activity->last()->description);
    }
}
