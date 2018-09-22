<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comment;
use App\Events\Comment\CommentCreated;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'videoId' => 'required'
        ]);

        $comments = Comment::where('video_id', $data['videoId'])
                        ->orderBy('id', 'desc')
                        ->get();

        return response($comments, 200); //we are sending all the comments
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => 'required|min:3',
            'videoId' => 'required'
        ]);

        $comment = Comment::create([
            'body' => $data['body'],
            'video_id' => $data['videoId'],
            'user_id' => Auth::user()->id,
            'is_published' => 1
        ]);

        $comment = Comment::find($comment->id);

        event(new CommentCreated($comment));

        return response($comment, 201);
    }
}
