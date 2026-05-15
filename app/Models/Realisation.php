<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Realisation extends Model
{
    use HasFactory;

    protected $table = 'realisations';

    protected $fillable = [
        'title',
        'description',
        'category',
        'image_path',
        'order',
        'is_active',
        'featured'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'featured' => 'boolean',
        'order' => 'integer'
    ];

    // Accesseur pour l'URL de l'image
    public function getImageUrlAttribute()
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }
}