<?php

namespace App\Http\Resources\GratitudeDiaries;

use App\Support\Http\Resources\Resource;

/**
 * @OA\Schema()
 */
class GratitudeDiaryResource extends Resource
{
    /**
     * @OA\Property(property="id", type="string")
     * @OA\Property(property="what", type="string")
     * @OA\Property(property="date", type="string", format="date")
     *
     * @param mixed $request
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'what' => $this->what,
            'date' => $this->date->format('Y-m-d'),
        ];
    }
}
