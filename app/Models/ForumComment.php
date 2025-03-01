<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    use HasFactory;

    protected $fillable = ['id','thread_id', 'user_id', 'content', 'created_at'];

    // Add this property to disable automatic handling of the `updated_at` column
    public $timestamps = false;  // Disable automatic timestamps handling

    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'forum_thread_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
