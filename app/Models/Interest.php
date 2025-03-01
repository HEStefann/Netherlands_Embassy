<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_interests', 'interest_id', 'user_id');
    }
}
