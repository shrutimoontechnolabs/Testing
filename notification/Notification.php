<?php

// app/Models/Notification.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['from_id', 'to_id', 'title', 'message', 'description'];

    // Optional: Define the relationship with the User model
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id'); // 'from_id' is the foreign key to the users table
    }


    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
