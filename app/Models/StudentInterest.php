<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInterest extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default pluralized name
    protected $table = 'student_interests';

    // Define the fields that can be mass-assigned
    protected $fillable = ['user_id', 'interest_id', 'created_at', 'updated_at'];
}
