<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class PostsController extends Controller
{
    public function create(Request $request)
    {
        $post = new Post;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Added new post.');
    }
}
