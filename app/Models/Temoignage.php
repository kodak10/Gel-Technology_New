<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Temoignage extends Model
{
    use HasFactory;

    protected $table = 'temoignages';

    protected $fillable = [
        'name',
        'position',
        'avatar_path',
        'message',
        'rating',
        'border_color',
        'social_links',
        'order',
        'is_active'
    ];

    protected $casts = [
        'rating' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean',
        'social_links' => 'array'
    ];

    public function getAvatarUrlAttribute()
    {
        return $this->avatar_path ? Storage::url($this->avatar_path) : null;
    }

    // Convertir rating en étoiles
    public function getStarsAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<li><span class="filled"></span></li>';
            } else {
                $stars .= '<li><span></span></li>';
            }
        }
        return $stars;
    }
}