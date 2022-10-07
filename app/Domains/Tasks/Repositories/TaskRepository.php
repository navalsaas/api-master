<?php

namespace App\Domains\Tasks\Repositories;

use App\Domains\Tasks\Task;
use App\Support\Domain\Repositories\UserRepository;
use App\Support\QueryBuilder\Filter;

class TaskRepository extends UserRepository
{
    protected $modelClass = Task::class;

    protected $allowedFilters = [
        'area_id',
        'name',
        'days',
        'order',
    ];

    public function newQuery()
    {
        $query = parent::newQuery();

        $query->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');

        return $query;
    }

    public function getAllowedFilters()
    {
        return array_merge(
            $this->allowedFilters,
            [
                Filter::scope('today'),
            ]
        );
    }

    public function toggle(Task $task)
    {
        if ($task->todayIsDone()) {
            $task->last_done = null;
        } else {
            $task->last_done = now();
        }

        return $task->save();
    }
}
