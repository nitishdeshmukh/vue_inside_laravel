<?php

namespace App\Repositories;

use App\Contracts\PostServiseInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PostRepository {
    public function createPost(array $data): ?Post{
        // dd($data);
        $post = new Post();
        $post->title = $data['title'];
        $post->author = $data['author'];
        $post->publication_date = $data['publication_date'];
        $post->description = $data['description'];
        $post->save();
        return $post;
    }

    // public function getAll(): ?Collection
    // {
    //     return Post::orderByDesc('created_at')->get();
    //     // return Post::orderBy('created_at', 'DESC')->paginate(5);
    // }

    public function deleteItem(Post $post)
    {
        return $post->delete();
    }

    public function editItem($postId)
    {
        return $post = DB::table('posts')->where('id',$postId)->first();
        // dd($post);
    }

    public function updateItem(array $data,$postId)
    {
        return $post = DB::table('posts')
        ->where('id',$postId)
        ->update(['title' => $data['title'], 'author' => $data['author'], 'publication_date' => $data['publication_date'], 'description' => $data['description']]);
        // dd($post);
    }

    public function fetchAll(array $filters)
    {
        // return $res = DB::table('posts')
        // ->where('id',$data['search'])
        // ->orWhere('title',$data['search'])
        // ->orWhere('publication_date',$data['search'])
        // ->orWhere('author',$data['search'])->get();

        // dd($filters['search']);
        $query = Post::query();

        if (!empty($filters)) {
            foreach ($filters as $column => $value) {
                // dd($filters,$value);
                if (!empty($value) && !is_null($value) && $value != 'null') {
                    if ($column === 'postId') {
                        $query->postId($value);
                    }    
                    elseif ($column === 'postTitle') {
                        $query->postTitle($value);
                    }
                    elseif ($column === 'postAuthor') {
                        $query->postAuthor($value);
                    }
                    elseif ($column === 'postPublicationDate') {
                        $query->postPublicationDate($value);
                    }
                    elseif ($column ==='anyThing') {
                        $query->searchAnyThing($value);
                    }
                }
            }
        }

        
        return $query->orderByDesc('created_at')->paginate(5);
    }

}