<?php

namespace App\Http\Controllers\Streaks;

use App\Domains\Streaks\Repositories\StreakRepository;
use App\Support\Http\Controllers\UserDestroyController;

class StreakDestroyController extends UserDestroyController
{
    /**
     * @OA\Delete(
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
     *   summary="Delete streak",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível excluir o streak"
     *   )
     * )
     */
    public function __invoke(string $streakId, StreakRepository $repository)
    {
        return $this->_destroy($streakId, $repository, 'Não foi possível excluir o streak');
    }
}
