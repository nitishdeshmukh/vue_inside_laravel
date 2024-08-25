<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Contracts\PostServiseInterface;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests;


class PostController extends Controller
{
    public function __construct(
        protected PostServiseInterface $postService
    ) {
    }

    public function getPostListPage(Request $req){
        $filters = $req->only(['postId', 'postTitle', 'postAuthor', 'postPublicationDate','anyThing']);
        // return $this->postService->fetchAll($filters);

        $res = $this->postService->fetchAll($filters);
        
        // dd($res->links());
        if(!$res){
            return redirect()->back()->withInput()->with('error', 'Post was not found');
        }
        return Inertia::render('post/PostList',[
            'postList' => $res
        ]);
    }

    public function getCreatePostPage(){
        return Inertia::render('post/CreatePost');
    }

    public function addPost(Requests\CreatePostRequest $req){
        try {
            $Post = $this->postService->createPost($req->all()); 
            if($Post){
                return redirect()->route('post.list')->with('success', 'Post created!');
            }   
            } 
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function deletePost(Post $postId){
        // dd($postId);
        try {
            if(is_null($postId)){
                return redirect()->back()->withErrors(['Post does not exist']);
            }
            $deleted = $this->postService->deleteItem($postId);
            if (!$deleted) {
                return redirect()->back()->withInput()->with('error', 'Post was not deleted!');
            }
            return redirect()->route('post.list')->with('success', 'Post delete!');
        } catch (\Exeption $e) {
            return response()->jason(['error' => $e -> getMessage()], 500);
        }
    }

    public function editPost($postId){
        // dd($postId);
        if(is_null($postId)){
            return redirect()->back()->withErrors(['Post does not exist']);
        }
        $post = $this->postService->editItem($postId);
        if (!$post) {
            return redirect()->back()->withInput()->with('error', 'Post was not updated!');
        }
        
        return Inertia::render('post/CreatePost',[
            'post'=> $post,
            'hasPostId'=> true
        ]);
    }

    public function updatePost(Request $req, $postId){
        try {
            if(is_null($postId)){
                return redirect()->back()->withErrors(['Post does not exist']);
            }
            $updated = $this->postService->updateItem($req->all(), $postId);
            if (!$updated) {
                return redirect()->back()->withInput()->with('error', 'Post was not updated!');
            }
            return redirect()->route('post.list')->with('success', 'Post was updated!');
        } catch (\Exeption $e) {
            return response()->jason(['error' => $e -> getMessage()], 500);
        }
    }

}
