<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    // In columns mein data save karne ki ijazat di ja rahi hai
    protected $fillable = [
        'title', 
        'category', 
        'description', 
        'link', 
        'file_path', 
        'citation', 
        'published_at', 
        'content'
    ];
}