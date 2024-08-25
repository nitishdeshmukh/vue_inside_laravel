<?php

namespace App\Repositories;

use App\Contracts\NoteServiceInterface;
use App\Models\Note;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NoteRepository 
{
    public function createNote(array $data): ?Note
    {
        $note = new Note;
        $note->title = $data['title'];
        $note->text = $data['text'];
        $note->save();
        return $note;
    }

    public function getAll(): ?Collection
    {
        return Note::get();
    }

    public function deleteItem(Note $note)
    {
        return $note->delete();
    }
}