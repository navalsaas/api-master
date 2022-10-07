<?php

namespace App\Http\Resources\Areas;

use App\Support\Http\Resources\Resource;

/**
 * @OA\Schema()
 */
class AreaResource extends Resource
{
    /**
     * @OA\Property(property="id", type="string")
     * @OA\Property(property="name", type="string")
     * @OA\Property(property="icon", type="string")
     * @OA\Property(property="comments", type="string")
     *
     * @param mixed $request
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'comments' => $this->comments,
        ];
    }
}
