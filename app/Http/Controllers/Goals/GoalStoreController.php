<?php

namespace App\Http\Controllers\Goals;

use App\Domains\Goals\Repositories\GoalRepository;
use App\Http\Requests\Goals\CreateGoalRequest;
use App\Http\Resources\Goals\GoalResource;
use App\Support\Http\Controllers\UserStoreController;

class GoalStoreController extends UserStoreController
{
    /**
     * @OA\Post(
     *   tags={"goals"},
     *   path="/goals",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create goal",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/CreateGoalRequest")
     *       )
     *   ),
     *   summary="Create goal",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/GoalResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="304",
     *     description="Falha ao criar objetivo"
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Informa os campos inválidos ou faltando"
     *   )
     * )
     */
    public function __invoke(CreateGoalRequest $request, GoalRepository $repository)
    {
        return $this->_store($request->validated(), $repository, GoalResource::class, 'Falha ao criar objetivo');
    }
}
