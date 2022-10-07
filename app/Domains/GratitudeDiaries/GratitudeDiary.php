<?php

namespace App\Domains\GratitudeDiaries;

use App\Support\Domain\Model;

class GratitudeDiary extends Model
{
    public $fillable = [
        'what',
        'date',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($diary) {
            if (!$diary->date) {
                $diary->date = now()->format('Y-m-d');
            }
        });
    }
}
