<?php

namespace App\Domains\Streaks\Repositories;

use App\Domains\Streaks\Streak;
use App\Support\Domain\Repositories\UserRepository;

class StreakRepository extends UserRepository
{
    protected $modelClass = Streak::class;

    protected $allowedFilters = [
        'area_id',

        'title',
        'date_start',
        'date_end',
    ];

    protected $defaultSort = '-created_at';
}
