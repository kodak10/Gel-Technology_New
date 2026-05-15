<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    // Accesseur pour l'URL de l'image (version corrigée)
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }
        
        // Retourner directement l'URL publique
        return asset($this->image_path);
    }
}