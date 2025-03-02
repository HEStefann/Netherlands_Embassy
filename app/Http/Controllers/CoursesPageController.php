<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesPageController extends Controller
{
    // Get the most viewed courses (based on lesson views)
    public function getMostViewed()
    {
        $courses = Course::with(['modules.lessons.views'])
            ->get()
            ->map(function ($course) {
                return [
                    'course_title' => $course->title,
                    'course_description' => $course->description,
                    'course_duration' => $course->modules->sum(fn($module) => $module->lessons->count()), // Total lessons as duration estimate
                    'view_count' => $course->modules->sum(fn($module) => $module->lessons->sum(fn($lesson) => $lesson->views->count())),
                ];
            })
            ->sortByDesc('view_count')
            ->take(5) // Limit to top 5 most viewed courses
            ->values();

        return response()->json([
            'most_viewed_courses' => $courses
        ]);
    }

    // Get "In Focus" courses (courses in the user's wishlist)
    public function getInFocus()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $courses = Wishlist::where('user_id', $user->id)
            ->with('course.modules.lessons')
            ->get()
            ->map(function ($wishlist) {
                $course = $wishlist->course;
                return [
                    'course_title' => $course->title,
                    'course_description' => $course->description,
                    'course_duration' => $course->modules->sum(fn($module) => $module->lessons->count()),
                ];
            });

        return response()->json([
            'in_focus_courses' => $courses
        ]);
    }

    // Get new courses (created in the last week)
    public function getNewCourses()
    {
        $courses = Course::with(['modules.lessons'])
            ->where('created_at', '>=', now()->subWeek())
            ->get()
            ->map(function ($course) {
                return [
                    'course_title' => $course->title,
                    'course_description' => $course->description,
                    'course_duration' => $course->modules->sum(fn($module) => $module->lessons->count()),
                    'instructors' => $course->professors->map(function ($professor) {
                        return [
                            'name' => $professor->name,
                            'position' => optional($professor->professorData)->position,
                            'company' => optional($professor->professorData)->company,
                        ];
                    }),
                ];
            });

        return response()->json([
            'new_courses' => $courses
        ]);
    }

    // Get instructor statistics
    public function getInstructorStats()
    {
        $instructors = Course::with('professors')
            ->get()
            ->flatMap(fn($course) => $course->professors)
            ->unique('id')
            ->map(function ($professor) {
                return [
                    'instructor_name' => $professor->name,
                    'instructor_picture' => $professor->profile_picture,
                    'courses_count' => $professor->coursesTaught->count(),
                ];
            });

        return response()->json([
            'instructor_stats' => $instructors->values(),
            'total_instructors' => $instructors->count(),
            'total_courses' => Course::count(),
            'total_students' => \App\Models\User::where('role_id', 3)->count(),
        ]);
    }

    // Search courses
    public function searchCourses(Request $request)
    {
        $searchTerm = $request->input('query');

        $courses = Course::with(['modules.lessons'])
            ->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
            ->get()
            ->map(function ($course) {
                return [
                    'course_title' => $course->title,
                    'course_description' => $course->description,
                    'course_duration' => $course->modules->sum(fn($module) => $module->lessons->count()),
                ];
            });

        return response()->json([
            'search_results' => $courses
        ]);
    }
}
