<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        return response()->json(Achievement::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $achievement = Achievement::create($data);
        return response()->json($achievement, 201);
    }

    public function show(Achievement $achievement)
    {
        return response()->json($achievement);
    }

    public function update(Request $request, Achievement $achievement)
    {
        $data = $request->validate([
            'title' => 'string',
            'description' => 'nullable|string'
        ]);

        $achievement->update($data);
        return response()->json($achievement);
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
