<?php

namespace App\Domains\Notes;

use App\Support\Domain\Model;

class Note extends Model
{
    public $fillable = [
        'title',
        'note',
        'favorite',
        'order',
    ];

    protected $casts = [
        'favorite' => 'bool',
    ];
}
