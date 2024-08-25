<?php

namespace App\Services;

use App\Repositories\NoteRepository;
use App\Contracts\NoteServiceInterface;
use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class NoteService implements NoteServiceInterface
{
    public function __construct(
        protected NoteRepository $noteRepository
    ) {
    }

   
    public function createNote(array $data): ?Note
    {
        return $this->noteRepository->createNote($data);
    }

    public function getAll(): ?Collection
    {
        return $this->noteRepository->getAll();
    }


    public function deleteItem(Note $note)
    {
        if ($note === null) {
            return false;
        }

        return $this->noteRepository->deleteItem($note);
    }
    
}
