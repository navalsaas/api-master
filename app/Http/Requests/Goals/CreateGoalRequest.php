<?php

namespace App\Http\Requests\Goals;

use App\Support\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 * required={"area_id", "title"}
 * )
 */
class CreateGoalRequest extends Request
{
    /**
     * @OA\Property(property="area_id", type="string")
     * @OA\Property(property="title", type="string")
     * @OA\Property(property="comments", type="string")
     *
     * @return void
     */
    public function rules()
    {
        $userId = auth()->id();

        return [
            'area_id' => [
                'required',
                Rule::exists('areas', 'id')
                    ->where('user_id', $userId)
                    ->whereNull('deleted_at'),
            ],
            'title' => [
                'required',
                'string',
                'max:255',
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
