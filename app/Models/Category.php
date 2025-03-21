<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';

    protected $fillable = ['name', 'description', 'status'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'category_id');
    }
}
