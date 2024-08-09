<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    public $incrementing = true;

    // Fillable attributes
    protected $fillable = [
        'user_name',
        'password',
    ];

    // Hidden attributes
    protected $hidden = [
        'password',
    ];

    // Disable automatic timestamps
    public $timestamps = false;
}
