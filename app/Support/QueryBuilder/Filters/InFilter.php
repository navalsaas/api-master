<?php

namespace App\Support\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class InFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if (!\is_array($value)) {
            $value = [$value];
        }

        return $query->whereIn($property, $value);
    }
}
