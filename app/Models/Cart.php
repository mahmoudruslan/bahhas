<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function Products()
    // {
    //     return $this->belongsToMany(Product::class, CartProduct::class);
    // }
    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class);
    }
}
