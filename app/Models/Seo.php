<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $fillable = [
        'meta_title', 
        'meta_author', 
        'meta_tag', 
        'meta_description', 
        'meta_keword', 
        'google_verification', 
        'meta_analytics', 
        'alexa_verification',
        'google_adsense'
    ];
}
