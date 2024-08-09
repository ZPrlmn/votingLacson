<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['name'];
    
    // Define the relationship with Candidate
    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'position_id', 'id');
    }
}

