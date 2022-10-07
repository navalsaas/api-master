<?php

namespace App\Http\Resources\Auth;

use App\Support\Http\Resources\Resource;

/**
 * @OA\Schema()
 */
class UserResource extends Resource
{
    /**
     * @OA\Property(property="id", type="string", format="uuid")
     * @OA\Property(property="name", type="string")
     * @OA\Property(property="email", type="string", format="email")
     *
     * @param mixed $request
     *
     * @return void
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
