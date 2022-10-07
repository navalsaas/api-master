<?php

namespace App\Http\Requests\Areas;

use App\Support\Http\Request;

/**
 * @OA\Schema(
 * required={"name", "icon"}
 * )
 */
class CreateAreaRequest extends Request
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
                'required',
                'string',
                'max:255',
            ],
            'icon' => [
                'required',
                'string',
                'in:'.implode(',', config('icons.list')),
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
