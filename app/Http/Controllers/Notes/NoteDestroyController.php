<?php

namespace App\Http\Controllers\Notes;

use App\Domains\Notes\Repositories\NoteRepository;
use App\Support\Http\Controllers\UserDestroyController;

class NoteDestroyController extends UserDestroyController
{
    /**
     * @OA\Delete(
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
     *   summary="Delete note",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível excluir a nota"
     *   )
     * )
     */
    public function __invoke(string $noteId, NoteRepository $repository)
    {
        return $this->_destroy($noteId, $repository, 'Não foi possível excluir a nota');
    }
}
