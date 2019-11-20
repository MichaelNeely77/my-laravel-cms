<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostRequest;

use App\Post;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Posts\UpdatePostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // upload the image
        $image = $request->image->store('posts');

        // create the post

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at

        ]);

        // flash the image

        session()->flash('success', 'Post has been successfully created');

        // redirect user
        return redirect(route('posts.index'));
        }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content']);
        // if new image
        if ($request->hasFile('image')) {
            // upload it

            $image = $request->image->store('posts');

            // delete old image
            $post->deleteImage();

            $data['image'] = $image;

        }

        // update attributes
        $post->update($data);

        // flash message
        session()->flash('success', 'Post updated successfully');

        // update user
        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()) {

            Storage::delete($post->image);

            $post->forceDelete();

        } else {

            $post->delete();
        }

        session()->flash('success', 'Post has been successfully deleted');

        return redirect(route('posts.index'));
    }

        /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */

     public function trashed() 
     {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with ('posts', $trashed);
     }

     public function restore($id)
     {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post has been successfully restored');

        return redirect()->back();
     }
}
