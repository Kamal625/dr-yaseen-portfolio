<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * In columns mein data save karne ki ijazat hai.
     * Profile Image aur YouTube dono yahan add kar diye gaye hain.
     */
    protected $fillable = [
        'research_interests',
        'google_scholar',
        'linkedin',
        'substack',
        'orcid',
        'researchgate',
        'profile_image', 
        'youtube'
    ];
}