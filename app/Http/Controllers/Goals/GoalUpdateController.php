<?php

namespace App\Http\Controllers\Goals;

use App\Domains\Goals\Repositories\GoalRepository;
use App\Http\Requests\Goals\UpdateGoalRequest;
use App\Http\Resources\Goals\GoalResource;
use App\Support\Http\Controllers\UserUpdateController;

class GoalUpdateController extends UserUpdateController
{
    /**
     * @OA\Put(
     *   tags={"goals"},
     *   path="/goals/{goal_id}",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create goal",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UpdateGoalRequest")
     *       )
     *   ),
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
     *   summary="Update goal",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/GoalResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível atualizar o objetivo"
     *   )
     * )
     */
    public function __invoke(string $goalId, UpdateGoalRequest $request, GoalRepository $repository)
    {
        return $this->_update($goalId, $request->validated(), $repository, GoalResource::class, 'Não foi possível atualizar o objetivo');
    }
}
