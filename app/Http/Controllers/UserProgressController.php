<?php

namespace App\Http\Controllers;

use App\Models\UserProgress;
use Illuminate\Http\Request;

class UserProgressController extends Controller
{
    public function index()
    {
        return response()->json(UserProgress::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'progress' => 'required|integer|min:0|max:100'
        ]);

        $progress = UserProgress::create($data);
        return response()->json($progress, 201);
    }

    public function show(UserProgress $userProgress)
    {
        return response()->json($userProgress);
    }

    public function update(Request $request, UserProgress $userProgress)
    {
        $data = $request->validate([
            'progress' => 'integer|min:0|max:100'
        ]);

        $userProgress->update($data);
        return response()->json($userProgress);
    }

    public function destroy(UserProgress $userProgress)
    {
        $userProgress->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
