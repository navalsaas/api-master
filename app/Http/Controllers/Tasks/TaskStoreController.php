<?php

namespace App\Http\Controllers\Tasks;

use App\Domains\Tasks\Repositories\TaskRepository;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Resources\Tasks\TaskResource;
use App\Support\Http\Controllers\UserStoreController;

class TaskStoreController extends UserStoreController
{
    /**
     * @OA\Post(
     *   tags={"tasks"},
     *   path="/tasks",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create task",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/CreateTaskRequest")
     *       )
     *   ),
     *   summary="Create task",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/TaskResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="304",
     *     description="Falha ao criar tarefa"
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Informa os campos inválidos ou faltando"
     *   )
     * )
     */
    public function __invoke(CreateTaskRequest $request, TaskRepository $repository)
    {
        return $this->_store($request->validated(), $repository, TaskResource::class, 'Falha ao criar tarefa');
    }
}
