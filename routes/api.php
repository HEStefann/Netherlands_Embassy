<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LessonViewController;
use App\Http\Controllers\ForumThreadController;
use App\Http\Controllers\StudentInterestController;
use App\Http\Controllers\ProfessorsDataController;
use App\Http\Controllers\StudentDataController;
use App\Http\Controllers\UserProgressController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ForumCommentController;
use App\Http\Controllers\NewsletterSubscriptionController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserResponseController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\LearningModeController;
use App\Http\Controllers\CoursesPageController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Most viewed courses
Route::get('/courses/most-viewed', [CoursesPageController::class, 'getMostViewed']);

// // In Focus courses (user's wishlist)
Route::get('/courses/in-focus', [CoursesPageController::class, 'getInFocus'])->middleware('auth:sanctum');

// // New courses
Route::get('/courses/new', [CoursesPageController::class, 'getNewCourses']);

// // Instructor statistics
Route::get('/courses/instructor-stats', [CoursesPageController::class, 'getInstructorStats']);

// // Course search
Route::get('/courses/search', [CoursesPageController::class, 'searchCourses']);

Route::get('/user/{id}/achievements', [UserDashboardController::class, 'userAchievements']);
Route::get('/leaderboard', [UserDashboardController::class, 'leaderboard']);
Route::get('/user/{id}/recommended-courses', [UserDashboardController::class, 'recommendedCourses']);
Route::get('/user/{id}/continue-learning', [UserDashboardController::class, 'continueLearning']);

Route::get('/learning-mode/{course_id}', [LearningModeController::class, 'show']);
Route::get('/course/{course_id}/preview', [PreviewController::class, 'preview']);
Route::get('user/{userId}/course/{courseId}/preview', [PreviewController::class, 'previewCourseWithProgress']);
Route::apiResource('getusers', UserController::class);
Route::apiResource('getroles', RoleController::class);
Route::apiResource('getstudent-interests', StudentInterestController::class);
Route::apiResource('getlesson-views', LessonViewController::class);
Route::apiResource('getmessage', MessageController::class);
Route::apiResource('getforumthread', ForumThreadController::class);
Route::apiResource('getcourse', CourseController::class);
Route::apiResource('getreview', ReviewController::class);
Route::apiResource('getprofessors-data', ProfessorsDataController::class);
Route::apiResource('getstudents-data', StudentDataController::class);
Route::apiResource('getuser-progress', UserProgressController::class);
Route::apiResource('getachievements', AchievementController::class);
Route::apiResource('getforum-comments', ForumCommentController::class);
Route::apiResource('getnewsletter-subscriptions', NewsletterSubscriptionController::class);
Route::apiResource('getwishlists', WishlistController::class);
Route::apiResource('getuser-responses', UserResponseController::class);
Route::apiResource('getinterests', InterestController::class);
require __DIR__.'/auth.php';