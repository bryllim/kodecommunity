<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $comment = new Comment;
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return redirect()->route('dashboard')->with('success', 'Added a new comment.');
    }
}
