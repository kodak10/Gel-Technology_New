<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_solution_id',
        'title',
        'slug',
        'short_description',
        'full_description',
        'image_path',
        'icon',
        'color',
        'link',
        'button_text',
        'order',
        'is_active',
        'featured'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'featured' => 'boolean',
        'order' => 'integer'
    ];

    public function categorie()
    {
        return $this->belongsTo(CategorieSolution::class, 'categorie_solution_id');
    }

    // Accesseur pour l'URL de l'image
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }
        
        return asset($this->image_path);
    }

    // Accesseur pour l'URL de l'icône
    public function getIconUrlAttribute()
    {
        if (!$this->icon) {
            return null;
        }
        
        return asset($this->icon);
    }

    // Scope pour les solutions mises en avant
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    // Scope pour les solutions actives
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}