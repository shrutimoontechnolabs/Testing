<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventlog extends Model
{
    //
    protected $guarded = [];
     // Optional: Add casting for metadata
    protected $casts = [
        'metadata' => 'array', // Automatically handle JSON metadata as array
    ];
}
