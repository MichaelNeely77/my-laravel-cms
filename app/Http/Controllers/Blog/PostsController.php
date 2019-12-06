<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;

class PostsController extends Controller
{
    public function show (Post $post) 
    {
        return view('blog.show')->with('post', $post);
    }

    public function category (Category $category) 
    {
        return view('blog.category')->with('category', $category)->with('posts', $category->posts()->sinmplePaginate(3));
    }

    public function tag (Tag $tag) 
    {
        return view('blog.tag')->with('tag', $tag)->with('posts', $tag->posts()->sinmplePaginate(3));
    }
}
