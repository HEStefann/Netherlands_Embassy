<?php

namespace App\Http\Controllers;

use App\Models\LessonView;
use Illuminate\Http\Request;

class LessonViewController extends Controller
{
    public function index()
    {
        return response()->json(LessonView::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'lesson_id' => 'required|exists:lessons,id',
            'viewed_at' => 'required|date'
        ]);

        $lessonView = LessonView::create($data);
        return response()->json($lessonView, 201);
    }

    public function show(LessonView $lessonView)
    {
        return response()->json($lessonView);
    }

    public function update(Request $request, LessonView $lessonView)
    {
        $data = $request->validate([
            'viewed_at' => 'date'
        ]);

        $lessonView->update($data);
        return response()->json($lessonView);
    }

    public function destroy(LessonView $lessonView)
    {
        $lessonView->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
