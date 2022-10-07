<?php

namespace App\Domains\Goals;

use App\Domains\Areas\Area;
use App\Support\Domain\Model;

class Goal extends Model
{
    public $fillable = [
        'area_id',
        'title',
        'comments',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
