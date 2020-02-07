<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Model\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Api\Post\PostRequest;
use App\Http\Resources\Admin\Post\{PostResource, PostCollection};

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->has('search') AND !empty($request->input('search'))) {
        //
        $search = $request->search;
        return new PostCollection(Post::where('title','like',"%$search%")->paginate(10));
      }
        //Return the pages for the Admin
        return  new PostCollection(Post::paginate(10));
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
    public function store(PostRequest $request)
    {
        //
        $post=new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->content = $request->content;
        $post->metatitle = $request->metatitle;
        $post->metadescription = $request->metadescription;
        $post->status = $request->status;
        $post->save();
        return new PostResource($page);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return new PostResource($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Post  $post
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
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->content = $request->content;
        $post->metatitle = $request->metatitle;
        $post->metadescription = $request->metadescription;
        $post->status = $request->status;
        $post->save();
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return response()->json([
        'message' => 'Post deleted successfully'], 200);
    }
}
