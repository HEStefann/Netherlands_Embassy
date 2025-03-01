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
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('student-interests', StudentInterestController::class);
Route::apiResource('lesson-views', LessonViewController::class);
Route::apiResource('message', MessageController::class);
Route::apiResource('forumthread', ForumThreadController::class);
Route::apiResource('course', CourseController::class);
Route::apiResource('review', ReviewController::class);
Route::apiResource('professors-data', ProfessorsDataController::class);
Route::apiResource('students-data', StudentDataController::class);
Route::apiResource('user-progress', UserProgressController::class);
Route::apiResource('achievements', AchievementController::class);
Route::apiResource('forum-comments', ForumCommentController::class);
Route::apiResource('newsletter-subscriptions', NewsletterSubscriptionController::class);
Route::apiResource('wishlists', WishlistController::class);
Route::apiResource('user-responses', UserResponseController::class);
Route::apiResource('interests', InterestController::class);
require __DIR__.'/auth.php';