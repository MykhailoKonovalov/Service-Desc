<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = [
        'theme', 'description', 'product_id', 'solution_date', 'user_id'
    ];

    public $timestamps = false;

    protected $hidden = [];
}
