<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;

class LearningModeController extends Controller
{
    public function show($course_id)
    {
        $course = Course::with(['modules.lessons', 'professors.professorData', 'reviews.user'])
            ->findOrFail($course_id);

        // Calculate average rating
        $averageRating = $course->reviews()->avg('rating');

        // Fetch top 3 reviews (latest first)
        $reviews = $course->reviews()
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($review) {
                return [
                    'user_name' => $review->user->name,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                ];
            });

        $data = [
            'course_title' => $course->title,
            'course_description' => $course->description,
            'course_duration' => $course->duration,
            'modules' => $course->modules->map(function ($module) {
                return [
                    'module_title' => $module->name,
                    'lessons' => $module->lessons->map(function ($lesson) {
                        return [
                            'lesson_title' => $lesson->title,
                            'lesson_duration' => $lesson->duration ?? 'N/A',
                        ];
                    })
                ];
            }),
            'instructors' => $course->professors->map(function ($professor) {
                return [
                    'name' => $professor->name,
                    'position' => optional($professor->professorData)->position,
                    'company' => optional($professor->professorData)->company,
                ];
            }),
            'average_rating' => round($averageRating, 1),
            'reviews' => $reviews,
        ];

        return response()->json($data);
    }
}
