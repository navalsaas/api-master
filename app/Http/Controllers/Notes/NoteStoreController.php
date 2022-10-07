<?php

namespace App\Http\Controllers\Notes;

use App\Domains\Notes\Repositories\NoteRepository;
use App\Http\Requests\Notes\CreateNoteRequest;
use App\Http\Resources\Notes\NoteResource;
use App\Support\Http\Controllers\UserStoreController;

class NoteStoreController extends UserStoreController
{
    /**
     * @OA\Post(
     *   tags={"notes"},
     *   path="/notes",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create note",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/CreateNoteRequest")
     *       )
     *   ),
     *   summary="Create note",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/NoteResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="304",
     *     description="Falha ao criar nota"
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Informa os campos inválidos ou faltando"
     *   )
     * )
     */
    public function __invoke(CreateNoteRequest $request, NoteRepository $repository)
    {
        return $this->_store($request->validated(), $repository, NoteResource::class, 'Falha ao criar nota');
    }
}
