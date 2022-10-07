<?php

namespace App\Http\Resources;

use App\Support\Http\Resources\Resource;

/**
 * @OA\Schema()
 */
class IndexResource extends Resource
{
    /**
     * @OA\Property(property="app_name", type="string")
     * @OA\Property(property="database", type="boolean")
     *
     * @param mixed $request
     */
    public function toArray($request)
    {
        return [
            'app_name' => $this->app_name,
            'database' => (bool) $this->database,
        ];
    }
}
