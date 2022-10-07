<?php

namespace App\Http\Controllers\Streaks;

use App\Domains\Streaks\Repositories\StreakRepository;
use App\Http\Resources\Streaks\StreakResource;
use App\Support\Http\Controllers\UserShowController;

class StreakShowController extends UserShowController
{
    /**
     * @OA\Get(
     *   tags={"streaks"},
     *   path="/streaks/{streak_id}",
     *   @OA\Parameter(
     *     name="streak_id",
     *     in="path",
     *     description="streak id",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         format="uuid"
     *     )
     *   ),
     *   summary="Get streak from id",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/StreakResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="404",
     *     description="Não foi possível encontrar o streak"
     *   )
     * )
     */
    public function __invoke(string $streakId, StreakRepository $repository)
    {
        return $this->_show($streakId, $repository, StreakResource::class, 'Não foi possível encontrar o streak');
    }
}
