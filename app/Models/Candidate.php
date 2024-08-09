<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['student_id', 'position_id', 'votes', 'image'];
    
    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'student_id');
    }
    
    // Define the relationship with Position
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}

