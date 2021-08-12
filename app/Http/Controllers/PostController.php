<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $response = [
            'success' => true,
            'data' => PostResource::collection($posts),
            'message' => 'post successfully recived',
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => true,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 403);
        } else {
            $post = Post::create($input);
            $response = [
                'success' => true,
                'data' => new PostResource($post),
                'message' => 'post successfully created',
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // ==   this is normal controller ======== 
        // return response()->json($post, 200);


        // ==========  this is collection controller ============= 
        if (is_null($post)) {
            $response = [
                "success" => false,
                "message" => "Post Not Found"
            ];
            return response()->json($response, 403);
        } else {
            $response = [
                "success" => true,
                "data" => new PostResource($post),
                "message" => "Post Successfully Recived"
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => true,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 403);
        } else {

            // $post->update($request->all());
            // return response()->json('Category updated!');

            $post->title = $input['title'];
            $post->content = $input['content'];
            $post->save();
            $response = [
                'success' => true,
                'data' => new PostResource($post),
                'message' => 'post successfully created',
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();


        $response = [
            'success' => true,
            'data' => [],
            'message' => "post successfully deleted"
        ];

        return response()->json($response, 200);
    }
}
