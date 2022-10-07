<?php

namespace App\Support\QueryBuilder;

use Spatie\QueryBuilder\QueryBuilder as SpatieQueryBuilder;

class QueryBuilder extends SpatieQueryBuilder
{
    protected $exceptionInvalidFilter = false;

    /**
     * Allow ignore invalid fields without throwing an exception.
     *
     * @param boll $value
     */
    public function setExceptionInvalidFilter(bool $value = true)
    {
        $this->exceptionInvalidFilter = $value;

        return $this;
    }

    protected function ensureAllFiltersExist()
    {
        if (!$this->exceptionInvalidFilter) {
            return;
        }

        return parent::ensureAllFiltersExist();
    }
}
