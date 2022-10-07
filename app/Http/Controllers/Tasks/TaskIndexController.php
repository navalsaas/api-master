<?php

namespace App\Http\Controllers\Tasks;

use App\Domains\Tasks\Repositories\TaskRepository;
use App\Domains\Tasks\Task;
use App\Http\Resources\Tasks\TaskResource;
use App\Support\Http\Controllers\UserIndexController;
use Illuminate\Http\Request;

class TaskIndexController extends UserIndexController
{
    /**
     * @OA\Get(
     *   tags={"tasks"},
     *   path="/tasks",
     *   summary="List of tasks",
     *   @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/TaskResource")))
     *   ),
     *   security={{
     *       "bearer":{}
     *    }},
     * )
     */
    public function __invoke(Request $request, TaskRepository $repository)
    {
        return $this->_index($request->all(), $repository, TaskResource::class, [
            'today' => Task::$DAYS[now()->dayOfWeek],
        ]);
    }
}
