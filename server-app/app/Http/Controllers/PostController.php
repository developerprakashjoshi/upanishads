<?php

namespace App\Http\Controllers;

use App\Services\PostService;

use App\Models\Post;
class PostController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService)  {
        $this->postService = $postService;
    }

    public function index(){
        $post=$this->postService->getAllPosts();
        dd($post->toArray());
        // return view('post.index',['posts'=>$post]);
    }
    public function show(Post $post){
        $post=$this->postService->getPostById($post->id);
        dd($post->toArray());
        // return view('post.index',['posts'=>$post]);
    }

    public function create(Post $post){

    }
}
