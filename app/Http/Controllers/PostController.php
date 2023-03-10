<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function viewSinglePost(Post $post) // type hinting could be $pizza
    {

        $ourHTML = strip_tags(Str::markdown($post->body), '<p><h1><h2><ul><li><strong><br>');
        $post['body'] = $ourHTML;

        return view('single-post', ['post' => $post]); // could be pizza
        //return $post->title;
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
        $newPost = Post::create($incomingFields);
        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created');
    }

    public function showCreateForm()
    {
        return view('create-post');
        //return "Hello from Post"
    }
}
