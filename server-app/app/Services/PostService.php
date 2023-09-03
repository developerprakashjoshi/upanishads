<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Interfaces\PostInterface;
use App\Services\Interfaces\PostServiceInterface;

class PostService implements PostServiceInterface
{
    private $postRepository;
    public function __construct(PostInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->all();
    }

    public function getPostById($id)
    {
        return $this->postRepository->find($id);
    }

    public function createPost(array $data)
    {
        return $this->postRepository->create($data);
    }

    public function updatePost($id, array $data)
    {
        return $this->postRepository->update($id, $data);
    }

    public function deletePost($id)
    {
        return $this->postRepository->delete($id);
    }

    public function restorePost($id)
    {
        return $this->postRepository->restore($id);
    }

    public function forceDeletePost($id)
    {
        return $this->postRepository->forceDelete($id);
    }
}
