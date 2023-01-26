<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function viewSinglePost(Post $post) // type hinting
    {
        //return $post->title;
        return view('single-post', ['post' => $post]);
        //return "single post test";
    }

    public function storeNewPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return $incomingFields;
    }

    public function showCreateForm()
    {
        return view('create-post');
        //return "Hello from Post"
    }
}
