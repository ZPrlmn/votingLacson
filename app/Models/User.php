<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['student_id', 'first_name', 'last_name', 'course', 'year', 'has_voted'];
    protected $primaryKey = 'student_id';    
    public $incrementing = false;    
    protected $keyType = 'string';
    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'student_id', 'student_id');
    }
}
