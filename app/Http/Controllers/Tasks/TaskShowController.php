<?php

namespace App\Http\Controllers\Tasks;

use App\Domains\Tasks\Repositories\TaskRepository;
use App\Http\Resources\Tasks\TaskResource;
use App\Support\Http\Controllers\UserShowController;

class TaskShowController extends UserShowController
{
    /**
     * @OA\Get(
     *   tags={"tasks"},
     *   path="/tasks/{task_id}",
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
     *   summary="Get task from id",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/TaskResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="404",
     *     description="Não foi possível encontrar a tarefa"
     *   )
     * )
     */
    public function __invoke(string $taskId, TaskRepository $repository)
    {
        return $this->_show($taskId, $repository, TaskResource::class, 'Não foi possível encontrar a tarefa');
    }
}
