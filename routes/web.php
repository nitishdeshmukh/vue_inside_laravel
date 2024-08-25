<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'getHomePage'])->name('home');

Route::name('note.')->group(function () {
    Route::get('/note/create', [NoteController::class, 'getCreateNotePage'])->name('create.page');
    Route::post('/note/add', [NoteController::class, 'addNote'])->name('add');
    Route::get('/notes', [NoteController::class, 'getNoteListPage'])->name('list');
    Route::delete('/note/{noteId:id}', [NoteController::class, 'deleteNote'])->name('delete');
});

Route::name('post.')->group(function (){
    Route::get('/post/create', [PostController::class, 'getCreatePostPage'])->name('create.page');
    Route::post('/post/add', [PostController::class, 'addPost'])->name('add');
    Route::get('/posts', [PostController::class, 'getPostListPage'])->name('list');
    // Route::get('/posts/search',[PostController::class, 'searchPost'])->name('search');
    Route::delete('/posts/{postId:id}', [PostController::class, 'deletePost'])->name('delete');
    Route::get('/post/{postId:id}', [PostController::class, 'editPost'])->name('edit');
    Route::put('/post/update/{postId:id}', [PostController::class, 'updatePost'])->name('update');
});