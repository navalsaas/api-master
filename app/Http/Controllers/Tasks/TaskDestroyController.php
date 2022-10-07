<?php

namespace App\Http\Controllers\Tasks;

use App\Domains\Tasks\Repositories\TaskRepository;
use App\Support\Http\Controllers\UserDestroyController;

class TaskDestroyController extends UserDestroyController
{
    /**
     * @OA\Delete(
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
     *   summary="Delete task",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível excluir a tarefa"
     *   )
     * )
     */
    public function __invoke(string $taskId, TaskRepository $repository)
    {
        return $this->_destroy($taskId, $repository, 'Não foi possível excluir a tarefa');
    }
}
