<?php

namespace App\Http\Controllers\Goals;

use App\Domains\Goals\Repositories\GoalRepository;
use App\Http\Resources\Goals\GoalResource;
use App\Support\Http\Controllers\UserShowController;

class GoalShowController extends UserShowController
{
    /**
     * @OA\Get(
     *   tags={"goals"},
     *   path="/goals/{goal_id}",
     *   @OA\Parameter(
     *     name="goal_id",
     *     in="path",
     *     description="goal id",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         format="uuid"
     *     )
     *   ),
     *   summary="Get goal from id",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/GoalResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="404",
     *     description="Não foi possível encontrar o objetivo"
     *   )
     * )
     */
    public function __invoke(string $goalId, GoalRepository $repository)
    {
        return $this->_show($goalId, $repository, GoalResource::class, 'Não foi possível encontrar o objetivo');
    }
}
