<?php

namespace App\Http\Requests\GratitudeDiaries;

use App\Support\Http\Request;

/**
 * @OA\Schema()
 */
class UpdateGratitudeDiaryRequest extends Request
{
    /**
     * @OA\Property(property="name", type="string")
     * @OA\Property(property="date", type="string", format="date")
     *
     * @return void
     */
    public function rules()
    {
        return [
            'what' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'date' => [
                'sometimes',
                'date',
                'date_format:Y-m-d',
            ],
        ];
    }
}
