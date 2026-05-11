<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * In columns mein data save karne ki ijazat di ja rahi hai (Mass Assignment).
     * Agar yahan kisi column ka naam miss ho gaya, to data save nahi hoga.
     */
    protected $fillable = [
        'title',        // Event ya image ka naam
        'image_path',   // Cover image ka rasta
        'description',  // Event ki tafseel
        'type',         // Category (Conference, Event, etc.)
        'video_url',    // YouTube ya Vimeo ka link
        'video_path'    // Direct upload ki hui MP4 file ka rasta
    ];
}