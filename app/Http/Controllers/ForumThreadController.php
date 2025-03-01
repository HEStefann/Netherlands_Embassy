<?php

namespace App\Http\Controllers;

use App\Models\ForumThread;
use Illuminate\Http\Request;

class ForumThreadController extends Controller
{
    public function index()
    {
        return ForumThread::all();
    }

    public function store(Request $request)
    {
        $thread = ForumThread::create($request->all());
        return response()->json($thread, 201);
    }

    public function show($id)
    {
        return ForumThread::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $thread = ForumThread::findOrFail($id);
        $thread->update($request->all());
        return response()->json($thread);
    }

    public function destroy($id)
    {
        ForumThread::destroy($id);
        return response()->json(null, 204);
    }
}
