<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'button_text',
        'button_link',
        'background_image',
        'order',
        'is_active'
    ];
}
