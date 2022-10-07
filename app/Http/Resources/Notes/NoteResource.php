<?php

namespace App\Http\Resources\Notes;

use App\Support\Http\Resources\Resource;

/**
 * @OA\Schema()
 */
class NoteResource extends Resource
{
    /**
     * @OA\Property(property="title", type="string")
     * @OA\Property(property="note", type="string")
     * @OA\Property(property="favorite", type="boolean")
     * @OA\Property(property="order", type="number")
     *
     * @param mixed $request
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'note' => $this->note,
            'favorite' => (bool) (int) $this->favorite,
            'order' => (int) $this->order,
        ];
    }
}
