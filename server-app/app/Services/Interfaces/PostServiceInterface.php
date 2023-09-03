<?php
namespace App\Services\Interfaces;

use App\Models\Post;

interface PostServiceInterface
{
    public function getAllPosts();
    public function getPostById($id);
    public function createPost(array $data);
    public function updatePost($id, array $data);
    public function deletePost($id);
    public function restorePost($id);
    public function forceDeletePost($id);
}
