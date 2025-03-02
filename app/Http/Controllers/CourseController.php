<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Instructor;
use App\Models\Review;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function store(Request $request)
    {
        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    public function show($id)
{
    $course = Course::with([
        'modules', 
        'professors',  // Eager load professors and their data
        'reviews'
    ])->findOrFail($id);

    return response()->json([
        'course' => $course,
        'modules' => $course->modules,
        'professors' => $course->professors,  // This will include professors and their data
        'reviews' => $course->reviews
    ]);
}


    

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return response()->json($course);
    }

    public function destroy($id)
    {
        Course::destroy($id);
        return response()->json(null, 204);
    }
}
