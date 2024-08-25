<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostController::class, 'getPostListPage'])->name('list');

// Route::post('/note/add', [NoteController::class, 'addNote'])->name('add.note');
// Route::get('/notes/get', [NoteController::class, 'getAllNotes'])->name('getAll.note');
// Route::delete('/note/{noteId:id}', [NoteController::class, 'deleteNote'])->name('delete');

