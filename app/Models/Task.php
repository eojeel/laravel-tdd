<?php

namespace App\Models;

use App\Models\Project;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    use RecordsActivity;
    use HasFactory;

    protected $guarded = [];
    protected $touches = ['project'];
    protected $casts = ['completed' => 'boolean'];
    protected static $recordableEVENTS = ['created', 'deleted'];

    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incompleted_task');
    }

    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
