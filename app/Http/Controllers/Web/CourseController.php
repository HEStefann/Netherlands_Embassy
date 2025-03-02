<?php
namespace App\Http\Controllers\Web;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CourseController extends Controller
{
    public function index()
    {
        // Return the view for displaying the list of courses
        $courses = Course::all(); // You can customize this to include pagination
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        // Return the view to create a new course
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        // Validate and store a new course
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
    }

    public function edit(Course $course)
    {
        // Return the view to edit an existing course
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        // Validate and update the course
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        // Delete the course
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');
    }
}

