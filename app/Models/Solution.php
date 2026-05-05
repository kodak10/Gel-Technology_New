<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getImageUrlAttribute()
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    public function getIconUrlAttribute()
    {
        return $this->icon ? Storage::url($this->icon) : null;
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