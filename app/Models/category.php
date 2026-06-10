<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'is_active'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * Get the primary key value with proper type declaration
     */
    public function getKey(): int
    {
        return $this->id;
    }
}
