<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $old = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' =>  $this->ActivityChanges($description)
        ]);
    }

    protected function ActivityChanges($description)
    {
        if ($description === 'updated')
        {
            return [
                'before' => array_diff( $this->old, $this->getAttributes()),
                'after' => array_diff($this->getAttributes(), $this->old)
            ];
        }
    }
}
