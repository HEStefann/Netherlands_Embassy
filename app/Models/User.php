<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 

    protected $fillable = [
        'id', 'name', 'email', 'password', 'profile_picture', 'role_id', 'created_at', 'updated_at'
    ];
    public function getPointsAttribute()
    {
        return floor($this->progress()->count() * 11);
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function professorData()
    {
        return $this->hasOne(ProfessorsData::class);
    }

    public function studentData()
    {
        return $this->hasOne(StudentData::class);
    }

    public function coursesTaught()
    {
        return $this->belongsToMany(Course::class, 'course_professor', 'professor_id', 'course_id');
    }

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function forumThreads()
    {
        return $this->hasMany(ForumThread::class);
    }

    public function forumComments()
    {
        return $this->hasMany(ForumComment::class);
    }

    public function newsletterSubscription()
    {
        return $this->hasOne(NewsletterSubscription::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function quizResponses()
    {
        return $this->hasMany(UserResponse::class);
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'student_interests', 'user_id', 'interest_id');
    }

    public function views()
    {
        return $this->hasMany(LessonView::class, 'user_id');
    }
}
