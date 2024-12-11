<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
        protected $fillable = [
        'title', 
        'start_date', 
        'end_date'
    ];

    // Optional: Cast dates to Carbon instances for better date handling
    protected $dates = [
        'start_date', 
        'end_date'
    ];
}
