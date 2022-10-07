<?php

namespace App\Http\Controllers\Notes;

use App\Domains\Notes\Repositories\NoteRepository;
use App\Http\Resources\Notes\NoteResource;
use App\Support\Http\Controllers\UserShowController;

class NoteShowController extends UserShowController
{
    /**
     * @OA\Get(
     *   tags={"notes"},
     *   path="/notes/{note_id}",
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
     *   summary="Get note from id",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/NoteResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="404",
     *     description="Não foi possível encontrar a nota"
     *   )
     * )
     */
    public function __invoke(string $noteId, NoteRepository $repository)
    {
        return $this->_show($noteId, $repository, NoteResource::class, 'Não foi possível encontrar a nota');
    }
}
