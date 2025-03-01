<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseProfessor extends Model
{
    // Table associated with the model
    protected $table = 'course_professor';

    // Disable timestamps since the table doesn't have created_at/updated_at columns
    public $timestamps = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'course_id',
        'professor_id',
    ];

    // Define the relationships

    // A course professor belongs to a course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // A course professor belongs to a professor (user)
    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }
}
