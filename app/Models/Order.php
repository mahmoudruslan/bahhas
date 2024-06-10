<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = true;

    public function productDetails()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getStatusAttribute($value)
    {
        return $value == 1 ? __("Complete") : __('Incomplete');
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i', strtotime($value));
    }
    public function getNotesAttribute($value)
    {
        return $value ?? __('Not found');
    }
}
