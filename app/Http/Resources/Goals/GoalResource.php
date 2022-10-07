<?php

namespace App\Http\Resources\Goals;

use App\Http\Resources\Areas\AreaResource;
use App\Support\Http\Resources\Resource;

/**
 * @OA\Schema()
 */
class GoalResource extends Resource
{
    /**
     * @OA\Property(property="id", type="string")
     * @OA\Property(property="area_id", type="string")
     * @OA\Property(property="title", type="string")
     * @OA\Property(property="comments", type="string")
     * @OA\Property(property="icon", type="string")
     * --OA\Property(property="area", type="object", ref="#/components/schemas/AreaResource")
     *
     * @param mixed $request
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'area_id' => $this->area_id,
            'title' => $this->title,
            'comments' => $this->comments,
            'icon' => $this->area->icon,
        ];
    }
}
