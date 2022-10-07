<?php

namespace App\Http\Controllers\Streaks;

use App\Domains\Streaks\Repositories\StreakRepository;
use App\Http\Requests\Streaks\UpdateStreakRequest;
use App\Http\Resources\Streaks\StreakResource;
use App\Support\Http\Controllers\UserUpdateController;

class StreakUpdateController extends UserUpdateController
{
    /**
     * @OA\Put(
     *   tags={"streaks"},
     *   path="/streaks/{streak_id}",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create streak",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UpdateStreakRequest")
     *       )
     *   ),
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
     *   summary="Update streak",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/StreakResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível atualizar o streak"
     *   )
     * )
     */
    public function __invoke(string $streakId, UpdateStreakRequest $request, StreakRepository $repository)
    {
        return $this->_update($streakId, $request->validated(), $repository, StreakResource::class, 'Não foi possível atualizar o streak');
    }
}
