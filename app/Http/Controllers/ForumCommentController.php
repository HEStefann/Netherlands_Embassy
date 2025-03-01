<?php

namespace App\Http\Controllers;

use App\Models\ForumComment;
use Illuminate\Http\Request;

class ForumCommentController extends Controller
{
    public function index()
    {
        return response()->json(ForumComment::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'forum_thread_id' => 'required|exists:forum_threads,id',
            'content' => 'required|string'
        ]);

        $comment = ForumComment::create($data);
        return response()->json($comment, 201);
    }

    public function show(ForumComment $forumComment)
    {
        return response()->json($forumComment);
    }

    public function update(Request $request, ForumComment $forumComment)
    {
        $data = $request->validate([
            'content' => 'string'
        ]);

        $forumComment->update($data);
        return response()->json($forumComment);
    }

    public function destroy(ForumComment $forumComment)
    {
        $forumComment->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
