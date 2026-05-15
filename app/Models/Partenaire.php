<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partenaire extends Model
{
    use HasFactory;

    protected $table = 'partenaires';

    protected $fillable = [
        'name',
        'logo_path',
        'link',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    // Accesseur pour l'URL du logo (version corrigée)
    public function getLogoUrlAttribute()
    {
        if (!$this->logo_path) {
            return null;
        }
        
        return asset($this->logo_path);
    }
}