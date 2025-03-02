<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function professors()
    {
        // Correct the eager load to professorsData instead of professorsData via the pivot table
        return $this->belongsToMany(User::class, 'course_professor', 'course_id', 'professor_id')
                    ->with('professorData'); // Make sure we're eager loading the professor's data
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
