<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'points'
    ];

    protected $table = 'achievements';

    public $timestamps = true;

    protected $casts = [
        'points' => 'integer',
        'description' => 'string', 
    ];
}
