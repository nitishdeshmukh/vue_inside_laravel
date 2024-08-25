<?php

namespace App\Contracts;

use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface NoteServiceInterface
{
    // no need here 
    
    // public function createNote(array $data): ?Note;

    public function getAll(): ?Collection;

    // public function deleteItem(Note $noteId): bool;
}
