<?php

namespace App\Http\Requests\Areas;

use App\Support\Http\Request;

/**
 * @OA\Schema()
 */
class UpdateAreaRequest extends Request
{
    /**
     * @OA\Property(property="name", type="string")
     * @OA\Property(property="icon", type="string")
     * @OA\Property(property="comments", type="string")
     *
     * @return void
     */
    public function rules()
    {
        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'icon' => [
                'sometimes',
                'string',
                'max:30',
            ],
            'comments' => [
                'nullable',
                'sometimes',
                'string',
                'max:255',
            ],
        ];
    }
}
