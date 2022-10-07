<?php

namespace App\Support\Domain;

use Illuminate\Support\Str;

trait UuidTrait
{
    public static function bootUuidTrait()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
}
