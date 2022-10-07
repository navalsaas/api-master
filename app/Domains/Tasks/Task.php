<?php

namespace App\Domains\Tasks;

use App\Domains\Areas\Area;
use App\Support\Domain\Model;

class Task extends Model
{
    public static $DAYS = [
        0 => 'sunday',
        1 => 'monday',
        2 => 'tuesday',
        3 => 'wednesday',
        4 => 'thursday',
        5 => 'friday',
        6 => 'saturday',
    ];

    public $fillable = [
        'area_id',
        'name',
        'days',
        'order',
    ];

    protected $casts = [
        'last_done' => 'date',
        'days' => 'array',
        'order' => 'integer',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function scopeToday($query, $today = true)
    {
        if ($today) {
            $day = self::$DAYS[now()->dayOfWeek];

            $query->whereJsonContains('days', [$day]);
        }
    }

    public function todayIsDone()
    {
        if (!$this->last_done) {
            return false;
        }

        $currentDay = self::$DAYS[now()->dayOfWeek];
        $day = self::$DAYS[$this->last_done->dayOfWeek];

        return $day === $currentDay;
    }
}
