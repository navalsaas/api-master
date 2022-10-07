<?php

namespace App\Http\Controllers\Notes;

use App\Domains\Notes\Repositories\NoteRepository;
use App\Http\Resources\Notes\NoteResource;
use App\Support\Http\Controllers\UserIndexController;
use Illuminate\Http\Request;

class NoteIndexController extends UserIndexController
{
    /**
     * @OA\Get(
     *   tags={"notes"},
     *   path="/notes",
     *   summary="List of notes",
     *   @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/NoteResource")))
     *   ),
     *   security={{
     *       "bearer":{}
     *    }},
     * )
     */
    public function __invoke(Request $request, NoteRepository $repository)
    {
        return $this->_index($request->all(), $repository, NoteResource::class);
    }
}
