<?php

namespace App\Domains\Areas\Repositories;

use App\Domains\Areas\Area;
use App\Support\Domain\Repositories\UserRepository;

class AreaRepository extends UserRepository
{
    protected $modelClass = Area::class;

    protected $allowedFilters = [
        'name',
        'icon',
        'comments',
    ];

    protected $defaultSort = 'name';
}
