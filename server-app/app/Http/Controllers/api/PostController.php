<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Database\QueryException;

class PostController extends Controller
{

    protected $postService;
    public function __construct(PostService $postService)  {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $post = $this->postService->getAllPosts();
            return response()->json(['message' => 'Post retrieve successfully', 'post' => $post], 201);
        }catch (QueryException $e) {
            // Handle the exception and return a JSON response with an error message
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        try{
            // Validate the incoming JSON data
            $validatedData = $request->validated();

            // Add the title as slug to the validated data
            $validatedData['slug'] = $validatedData['title'];

            //Passing $validatedData to the postService createPost method
            $post = $this->postService->createPost($validatedData);

            // Return a JSON response indicating success or failure
            return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
        }catch (QueryException $e) {
            // Handle the exception and return a JSON response with an error message
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $post = $this->postService->getPostById($id);
            return response()->json(['message' => "Post id $id retrieve successfully", 'post' => $post], 201);
        }catch (QueryException $e) {
            // Handle the exception and return a JSON response with an error message
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePostRequest $request, string $id)
    {
        try{
            // Validate the incoming JSON data
            $validatedData = $request->validated();

            // Add the title as slug to the validated data
            $validatedData['slug'] = $validatedData['title'];

            //Passing $validatedData to the postService createPost method
            $post = $this->postService->updatePost($id,$validatedData);

            // Return a JSON response indicating success or failure
            return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
        }catch (QueryException $e) {
            // Handle the exception and return a JSON response with an error message
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            // Find the post by ID
            $post = $this->postService->deletePost($id);

            // Check if the post exists
            if (!$post) {
                return response()->json(['message' => 'Post not found'], 404);
            }
            // Delete the post
            return response()->json(['message' => 'Post deleted successfully'], 200);
        }catch (QueryException $e) {
            // Handle the exception and return a JSON response with an error message
            return response()->json(['message' => $e->getMessage(),'post'=>$post], 422);
        }
    }
    public function restore(string $id)
    {
        try{
            // Find the post by ID
            $post = $this->postService->restorePost($id);

            // Check if the post exists
            if (!$post) {
                return response()->json(['message' => 'Post not found in trash'], 404);
            }
            // Delete the post
            return response()->json(['message' => 'Post restore successfully'], 200);
        }catch (QueryException $e) {
            // Handle the exception and return a JSON response with an error message
            return response()->json(['message' => $e->getMessage(),'post'=>$post], 422);
        }
    }
    public function forceDelete(string $id)
    {
        try{
            // Find the post by ID
            $post = $this->postService->forceDeletePost($id);

            // Check if the post exists
            if (!$post) {
                return response()->json(['message' => 'Post not found in trash'], 404);
            }
            // Delete the post
            return response()->json(['message' => 'Post permanently deleted'], 200);
        }catch (QueryException $e) {
            // Handle the exception and return a JSON response with an error message
            return response()->json(['message' => $e->getMessage(),'post'=>$post], 422);
        }
    }
}
