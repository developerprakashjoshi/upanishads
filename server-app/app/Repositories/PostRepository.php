<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PostInterface;
use App\Models\Post;

class PostRepository implements PostInterface
{
    public function find($id)
    {
        return Post::find($id);
    }

    public function all()
    {
        return Post::paginate(10);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->find($id);
        if (!$post) {
            return false;
        }
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->find($id);
        if (!$post) {
            return false;
        }
        return $post->delete();
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first($columns = ['*']);
        if (!$post) {
            return false;
        }
        return $post->restore();
    }

    public function forceDelete($id){
        $post = Post::withTrashed()->where('id', $id)->first($columns = ['*']);
        if (!$post) {
            return false;
        }
        return $post->forceDelete();
    }
}
