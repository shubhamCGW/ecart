<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'sub_desc',
        'description',
        'category_id',
        'favourite',
        'status',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }
}
