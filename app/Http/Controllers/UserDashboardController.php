<?php

namespace App\Http\Controllers;
use App\Models\Achievement;
use App\Models\User;
use App\Models\Course;
use App\Models\StudentInterest;
use App\Models\UserProgress;
use App\Models\Lesson;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{


public function userAchievements($userId)
{
    $achievements = Achievement::where('user_id', $userId)->get();

    return response()->json($achievements);
}


public function leaderboard()
{
    $topUsers = User::withCount('progress') // Count lessons completed
        ->get()
        ->map(function ($user) {
            return [
                'name' => $user->name,
                'completed_lessons' => $user->progress_count,
                'points' => floor($user->progress_count * 11),
                'achievements' => $user->achievements->count(),
            ];
        })
        ->sortByDesc('points') // Sort in descending order
        ->values(); // Reindex array

    return response()->json($topUsers);
}


public function recommendedCourses($userId)
{
    // Get user interests
    $interestIds = StudentInterest::where('user_id', $userId)->pluck('interest_id');

    // Get courses in matching categories
    $courses = Course::whereIn('category_id', $interestIds)->take(6)->get();

    return response()->json($courses);
}


public function continueLearning($userId)
{
    // Get lessons that are not completed by the user
    $pendingLessons = Lesson::whereNotIn(
        'id',
        UserProgress::where('user_id', $userId)->pluck('lesson_id')
    )->take(5)->get();

    return response()->json($pendingLessons);
}

}
