<?php

namespace App\Http\Controllers\GratitudeDiaries;

use App\Domains\GratitudeDiaries\Repositories\GratitudeDiaryRepository;
use App\Http\Resources\GratitudeDiaries\GratitudeDiaryResource;
use App\Support\Http\Controllers\UserIndexController;
use Illuminate\Http\Request;

class GratitudeDiaryIndexController extends UserIndexController
{
    /**
     * @OA\Get(
     *   tags={"gratitude-diaries"},
     *   path="/gratitude-diaries",
     *   summary="List of gratitude diaries",
     *   @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/GratitudeDiaryResource")))
     *   ),
     *   security={{
     *       "bearer":{}
     *    }},
     * )
     */
    public function __invoke(Request $request, GratitudeDiaryRepository $repository)
    {
        return $this->_index($request->all(), $repository, GratitudeDiaryResource::class, [
            'today' => now()->format('Y-m-d'),
        ]);
    }
}
