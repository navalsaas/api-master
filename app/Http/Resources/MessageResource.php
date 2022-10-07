<?php

namespace App\Http\Resources;

use App\Support\Http\Resources\Resource;

/**
 * @OA\Schema()
 */
class MessageResource extends Resource
{
    /**
     * @OA\Property(property="message", type="string")
     *
     * @param mixed $request
     */
    public function toArray($request)
    {
        return [
            'message' => $this->message,
        ];
    }
}
