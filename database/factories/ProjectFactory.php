<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Project;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'owner_id' => function () {
                return User::factory()->create()->id;
            }
        ];
    }
}
