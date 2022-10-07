<?php

namespace App\Domains\Notes\Repositories;

use App\Domains\Notes\Note;
use App\Support\Domain\Repositories\UserRepository;

class NoteRepository extends UserRepository
{
    protected $modelClass = Note::class;

    protected $allowedFilters = [
        'title',
        'note',
        'favorite',
    ];

    protected $defaultSort = 'order';

    public function newQuery()
    {
        $query = parent::newQuery();

        $query->orderBy('favorite', 'desc')
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc');

        return $query;
    }
}
