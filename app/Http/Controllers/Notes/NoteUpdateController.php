<?php

namespace App\Http\Controllers\Notes;

use App\Domains\Notes\Repositories\NoteRepository;
use App\Http\Requests\Notes\UpdateNoteRequest;
use App\Http\Resources\Notes\NoteResource;
use App\Support\Http\Controllers\UserUpdateController;

class NoteUpdateController extends UserUpdateController
{
    /**
     * @OA\Put(
     *   tags={"notes"},
     *   path="/notes/{note_id}",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create note",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UpdateNoteRequest")
     *       )
     *   ),
     *   @OA\Parameter(
     *     name="note_id",
     *     in="path",
     *     description="note id",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         format="uuid"
     *     )
     *   ),
     *   summary="Update note",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/NoteResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível atualizar a nota"
     *   )
     * )
     */
    public function __invoke(string $noteId, UpdateNoteRequest $request, NoteRepository $repository)
    {
        return $this->_update($noteId, $request->validated(), $repository, NoteResource::class, 'Não foi possível atualizar a nota');
    }
}
