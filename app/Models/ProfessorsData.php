<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorsData extends Model
{
    use HasFactory;

    protected $table = 'professors_data';

    protected $fillable = [
        'id','user_id', 'position', 'company', 'gender', 'birth_date', 'work_experience'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

