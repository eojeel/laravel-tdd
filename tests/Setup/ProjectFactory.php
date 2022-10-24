<?php

namespace Tests\Setup;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;

class ProjectFactory
{
    Protected $tasksCount = 0;
    Protected $user;

    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function create()
    {
        $project = Project::factory()->create([
            'owner_id' => $this->user ?? User::factory()->create()
        ]);

        Task::factory($this->tasksCount)->create([
            'project_id' => $project
        ]);

        return $project;
    }

}
