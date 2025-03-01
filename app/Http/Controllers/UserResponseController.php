<?php

namespace App\Http\Controllers;

use App\Models\UserResponse;
use Illuminate\Http\Request;

class UserResponseController extends Controller
{
    public function index()
    {
        return response()->json(UserResponse::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'quiz_id' => 'required|exists:quizzes,id',
            'score' => 'required|integer'
        ]);

        $response = UserResponse::create($data);
        return response()->json($response, 201);
    }

    public function show(UserResponse $userResponse)
    {
        return response()->json($userResponse);
    }

    public function update(Request $request, UserResponse $userResponse)
    {
        $data = $request->validate([
            'score' => 'integer'
        ]);

        $userResponse->update($data);
        return response()->json($userResponse);
    }

    public function destroy(UserResponse $userResponse)
    {
        $userResponse->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
