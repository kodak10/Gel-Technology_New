<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieSolution extends Model
{
    use HasFactory;

    protected $table = 'categorie_solutions';

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function solutions()
    {
        return $this->hasMany(Solution::class, 'categorie_solution_id');
    }

    public function activeSolutions()
    {
        return $this->solutions()->where('is_active', true)->orderBy('order');
    }

    // Accesseur pour l'icône
    public function getIconUrlAttribute()
    {
        if (!$this->icon) {
            return null;
        }
        
        return asset($this->icon);
    }
}