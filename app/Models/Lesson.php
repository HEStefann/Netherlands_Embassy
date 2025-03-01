<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['module_id', 'title', 'content', 'video_url', 'order_number'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function views()
    {
        return $this->hasMany(LessonView::class, 'lesson_id');
    }
}

