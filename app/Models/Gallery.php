<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    // In saare columns ka naam yahan hona laazmi hai
    protected $fillable = ['title', 'type', 'description', 'image_path', 'video_url', 'video_path'];
}