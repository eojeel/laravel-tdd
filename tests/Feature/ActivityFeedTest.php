<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    function test_creating_a_project_generates_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1 ,$project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    function test_updating_a_project_generates_acitivity()
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'Changed']);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);

    }
}
