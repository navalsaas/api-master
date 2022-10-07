<?php

namespace App\Support\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed                    $relation
     *
     * @return array
     */
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }

    protected function parseRelation($relation, string $class)
    {
        if (!$relation) {
            return [];
        }

        return $class::make($relation);
    }
}
