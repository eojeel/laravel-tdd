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
    }
}
