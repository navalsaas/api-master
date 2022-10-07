<?php

namespace App\Http\Requests\Streaks;

use App\Support\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema()
 */
class UpdateStreakRequest extends Request
{
    /**
     * @OA\Property(property="area_id", type="string")
     * @OA\Property(property="title", type="string")
     * @OA\Property(property="date_start", type="string", format="date-time")
     * @OA\Property(property="date_end", type="string", format="date-time")
     *
     * @return void
     */
    public function rules()
    {
        $userId = auth()->id();

        return [
            'area_id' => [
                'sometimes',
                Rule::exists('areas', 'id')
                    ->where('user_id', $userId)
                    ->whereNull('deleted_at'),
            ],
            'title' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'date_start' => [
                'sometimes',
                'required_with:date_end',
                'date',
            ],
            'date_end' => [
                'sometimes',
                'date',
                'after_or_equal:date_start',
            ],
        ];
    }
}
