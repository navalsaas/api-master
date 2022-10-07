<?php

namespace App\Http\Controllers\Tasks;

use App\Domains\Tasks\Repositories\TaskRepository;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\Tasks\TaskResource;
use App\Support\Http\Controllers\UserUpdateController;

class TaskUpdateController extends UserUpdateController
{
    /**
     * @OA\Put(
     *   tags={"tasks"},
     *   path="/tasks/{task_id}",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Update task",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UpdateTaskRequest")
     *       )
     *   ),
     *   @OA\Parameter(
     *     name="task_id",
     *     in="path",
     *     description="task id",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         format="uuid"
     *     )
     *   ),
     *   summary="Update task",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/TaskResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível atualizar a tarefa"
     *   )
     * )
     */
    public function __invoke(string $taskId, UpdateTaskRequest $request, TaskRepository $repository)
    {
        return $this->_update($taskId, $request->validated(), $repository, TaskResource::class, 'Não foi possível atualizar a tarefa');
    }
}
