<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;
    protected $table = 'games';
    protected $fillable = [
        'name',
        'price',
        'sale',
        'image',
        'video',
        'short_description',
        'detailed_description',
        'rating',
        'views',
        'tags',
        'status',
        'sold',
        'category_id',
    ];

    public function scopeActive($query)
    {
        return $query->where('games.status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
