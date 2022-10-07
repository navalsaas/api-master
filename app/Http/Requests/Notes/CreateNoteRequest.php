<?php

namespace App\Http\Requests\Notes;

use App\Support\Http\Request;

/**
 * @OA\Schema(
 * required={"title"}
 * )
 */
class CreateNoteRequest extends Request
{
    /**
     * @OA\Property(property="title", type="string")
     * @OA\Property(property="note", type="string")
     * @OA\Property(property="favorite", type="boolean")
     * @OA\Property(property="order", type="number")
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'note' => [
                'sometimes',
                'string',
            ],
            'favorite' => [
                'sometimes',
                'boolean',
            ],
            'order' => [
                'sometimes',
                'integer',
            ],
        ];
    }
}
