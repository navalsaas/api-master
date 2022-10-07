<?php

namespace App\Http\Controllers\Streaks;

use App\Domains\Streaks\Repositories\StreakRepository;
use App\Http\Resources\Streaks\StreakResource;
use App\Support\Http\Controllers\UserIndexController;
use Illuminate\Http\Request;

class StreakIndexController extends UserIndexController
{
    /**
     * @OA\Get(
     *   tags={"streaks"},
     *   path="/streaks",
     *   summary="List of streaks",
     *   @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/StreakResource")))
     *   ),
     *   security={{
     *       "bearer":{}
     *    }},
     * )
     */
    public function __invoke(Request $request, StreakRepository $repository)
    {
        return $this->_index($request->all(), $repository, StreakResource::class);
    }
}
