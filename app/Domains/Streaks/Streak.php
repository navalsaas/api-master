<?php

namespace App\Domains\Streaks;

use App\Domains\Areas\Area;
use App\Support\Domain\Model;

class Streak extends Model
{
    public $fillable = [
        'area_id',

        'title',
        'date_start',
        'date_end',
    ];

    protected $casts = [
        'date_start' => 'date:Y-m-d',
        'date_end' => 'date:Y-m-d',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($streak) {
            if (!$streak->date_start) {
                $streak->date_start = now();
            }
        });
    }

    public function getStreakDaysAttribute()
    {
        $start = $this->date_start;
        $end = $this->date_end;

        if (!$end) {
            $now = now();

            $end = $now->greaterThan($start) ? $now : $start;
        }

        return $end->diffInDays($start);
    }
}
