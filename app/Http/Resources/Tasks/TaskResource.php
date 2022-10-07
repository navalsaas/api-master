<?php

namespace App\Http\Resources\Tasks;

use App\Http\Resources\Areas\AreaResource;
use App\Support\Http\Resources\Resource;

/**
 * @OA\Schema()
 */
class TaskResource extends Resource
{
    /**
     * @OA\Property(property="area_id", type="string")
     * @OA\Property(property="name", type="string")
     * @OA\Property(property="days", type="string")
     * @OA\Property(property="order", type="number")
     * @OA\Property(property="icon", type="string")
     * @OA\Property(property="today_is_done", type="boolean")
     * @OA\Property(property="area_id", type="string")
     * OA\Property(property="area", type="object", ref="#/components/schemas/AreaResource")
     *
     * @param mixed $request
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'days' => $this->days,
            'order' => $this->order,
            'icon' => $this->area->icon,
            'today_is_done' => $this->todayIsDone(),
            'area_id' => $this->area_id,
            'area' => new AreaResource($this->area),
        ];
    }
}
