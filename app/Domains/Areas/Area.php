<?php

namespace App\Domains\Areas;

use App\Domains\Streaks\Streak;
use App\Domains\Tasks\Task;
use App\Support\Domain\Model;

class Area extends Model
{
    public $fillable = [
        'name',
        'icon',
        'comments',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function streaks()
    {
        return $this->hasMany(Streak::class);
    }
}
