<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'theme', 'description', 'detection_date', 'solution_time',
        'username', 'email', 'product_id', 'solution_id', 'status'
    ];

    public $timestamps = false;

    protected $hidden = [];
}
