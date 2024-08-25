<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Contracts\PostServiseInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PostService implements PostServiseInterface
{
    public function __construct(
        protected PostRepository $postRepository
    ) {
    }


    public function createPost(array $data): ?Post
    {
        return $this->postRepository->createPost($data);
    }

    public function getAll(): ?Collection
    {
        return $this->postRepository->getAll();
    }


    public function deleteItem(Post $post)
    {
        if ($post === null) {
            return false;
        }

        return $this->postRepository->deleteItem($post);
    }
    
    public function editItem($postId){
        return $this->postRepository->editItem($postId);
    }

    public function updateItem(array $data,$postId){
        return $this->postRepository->updateItem($data,$postId);
    }

    public function fetchAll($filters){
        // dd($this->postRepository->fetchAll($filters));
        return $this->postRepository->fetchAll($filters);
    }
}
