<?php

namespace App\Domains\GratitudeDiaries\Repositories;

use App\Domains\GratitudeDiaries\GratitudeDiary;
use App\Support\Domain\Repositories\UserRepository;
use App\Support\QueryBuilder\Filter;

class GratitudeDiaryRepository extends UserRepository
{
    protected $modelClass = GratitudeDiary::class;

    protected $allowedFilters = [
        'what',
    ];

    public function newQuery()
    {
        $query = parent::newQuery()
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        return $query;
    }

    public function getAllowedFilters()
    {
        return array_merge(
            $this->allowedFilters,
            [
                Filter::exact('date'),
            ]
        );
    }
}
