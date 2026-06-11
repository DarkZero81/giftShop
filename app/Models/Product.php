<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'price', 'image', 'stock', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
