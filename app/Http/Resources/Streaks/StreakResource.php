<?php

namespace App\Http\Resources\Streaks;

use App\Support\Http\Resources\Resource;

/**
 * @OA\Schema()
 */
class StreakResource extends Resource
{
    /**
     * @OA\Property(property="area_id", type="string")
     * @OA\Property(property="title", type="string")
     * @OA\Property(property="date_start", type="string", format="date")
     * @OA\Property(property="date_end", type="string", format="date")
     * @OA\Property(property="streak_days", type="number")
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
            'date_start' => $this->date_start->format('Y-m-d'),
            'date_end' => $this->date_end ? $this->date_end->format('Y-m-d') : null,
            'streak_days' => $this->streak_days,
            'icon' => $this->area->icon,
        ];
    }
}
