<?php

namespace App\Http\Controllers\Tasks;

use App\Domains\Tasks\Repositories\TaskRepository;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\Tasks\TaskResource;
use App\Support\Http\Controllers\UserUpdateController;
use Illuminate\Http\Response;

class TaskToggleController extends UserUpdateController
{
    /**
     * @OA\Put(
     *   tags={"tasks"},
     *   path="/tasks/{task_id}/toggle",
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
     *   summary="Toggle task",
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
        $task = $repository
            ->setUserId(auth()->id())
            ->findById($taskId);

        if (!$task) {
            return response()->json(['message' => 'Não foi possível atualizar a tarefa', 'code' => Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
        }

        $updated = $repository->toggle($task);

        if (!$updated) {
            return response()->json(['message' => 'Não foi possível atualizar a tarefa', 'code' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new TaskResource($task);
    }
}
