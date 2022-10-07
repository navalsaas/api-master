<?php

namespace App\Http\Controllers\Goals;

use App\Domains\Goals\Repositories\GoalRepository;
use App\Support\Http\Controllers\UserDestroyController;

class GoalDestroyController extends UserDestroyController
{
    /**
     * @OA\Delete(
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
     *   summary="Delete goal",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível excluir o objetivo"
     *   )
     * )
     */
    public function __invoke(string $goalId, GoalRepository $repository)
    {
        return $this->_destroy($goalId, $repository, 'Não foi possível excluir o objetivo');
    }
}
