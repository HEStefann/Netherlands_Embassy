<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\LessonView;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function preview($course_id)
    {
        // Fetch the course with its related modules, lessons, and professors
        $course = Course::with(['modules.lessons', 'professors', 'modules.lessons.views'])
            ->findOrFail($course_id);

        // Prepare the response data
        $data = [
            'course_title' => $course->title,
            'course_description' => $course->description,
            'instructors' => $course->professors->map(function ($professor) {
                return [
                    'name' => $professor->name,
                    'position' => optional($professor->professorData)->position,
                    'company' => optional($professor->professorData)->company,
                ];
            }),
            'lessons' => $course->modules->map(function ($module) {
                return $module->lessons->map(function ($lesson) {
                    return [
                        'lesson_title' => $lesson->title,
                        'lesson_content' => $lesson->content,
                        'lesson_video_url' => $lesson->video_url,
                        'view_count' => $lesson->views->count(),
                    ];
                });
            }),
        ];

        // Return the data as a response
        return response()->json($data);
    }
    public function previewCourseWithProgress($userId, $courseId)
    {
        // Fetch the course with its modules and lessons
        $course = Course::with('modules.lessons')->findOrFail($courseId);
        
        // Fetch user progress for lessons in the course
        $userProgress = UserProgress::where('user_id', $userId)
                                    ->whereIn('lesson_id', $course->modules->flatMap(function ($module) {
                                        return $module->lessons->pluck('id');
                                    }))
                                    ->get();

        // Prepare the data
        $courseData = [
            'course_title' => $course->title,
            'course_description' => $course->description,
            'instructor' => $course->professors->first() ? $course->professors->first()->name : 'No Instructor', // Get the first professor name
            'modules' => $course->modules->map(function ($module) use ($userProgress) {
                return [
                    'module_name' => $module->name,
                    'lessons' => $module->lessons->map(function ($lesson) use ($userProgress) {
                        $lessonProgress = $userProgress->where('lesson_id', $lesson->id)->first();
                        return [
                            'lesson_title' => $lesson->title,
                            'completed' => $lessonProgress ? $lessonProgress->completed : false,
                            'progress_percentage' => $lessonProgress ? $lessonProgress->progress_percentage : 0,
                        ];
                    }),
                ];
            })
        ];

        return response()->json($courseData);
    }
}
