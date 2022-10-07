<?php

namespace App\Domains\Goals\Repositories;

use App\Domains\Goals\Goal;
use App\Support\Domain\Repositories\UserRepository;

class GoalRepository extends UserRepository
{
    protected $modelClass = Goal::class;

    protected $allowedFilters = [
        'area_id',

        'title',
        'comments',
    ];

    protected $defaultSort = '-created_at';
}
