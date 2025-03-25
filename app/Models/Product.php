<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'stock', 'price', 'category'];

    public function scopeCategory(Builder $query): void
    {
        $category = request()->query('categories');
        if ($category) $query->where('category', $category);
    }
}
