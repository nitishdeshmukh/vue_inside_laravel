<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\NoteServiceInterface;
use Inertia\Inertia;
use App\Http\Requests;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;



class NoteController extends Controller
{

    public function __construct(
        protected NoteServiceInterface $noteService
    ) {
    }

    public function getNoteListPage()
    {
        return Inertia::render('note/NoteList',[
            'noteList' => $this->noteService->getAll(),
        ]);
    }
    public function getCreateNotePage()
    {
        return Inertia::render('note/CreateNote');
    }

    public function addNote(Requests\CreateNoteRequest $req)
    {
        try {
            $note = $this->noteService->createNote($req->all()); 
            
            if($note){
                return redirect()->route('note.list')->with('success', 'Note created!');
                // return response()->json(['note' => $note, 'msg' => 'Note created!']);
            }   
            } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteNote(Note $noteId)
    {      
        try {      
            if (is_null($noteId)) {
                return redirect()->back()->withErrors(['Note does not exist!']);
            }
            
            $deleted = $this->noteService->deleteItem($noteId);
            if (!$deleted) {
                return redirect()->back()->withInput()->with('error', 'Note was not deleted!');
            } 
             return redirect()->route('note.list')->with('success', 'Note deleted!');
            } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
 
}
