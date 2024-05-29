<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function status()
    {
        return $this->status == 0 ?  'Inactive' : 'Active';
    }

//     public function orderProducts()
//     {
//         return $this->hasMany(OrderProducts::class);
//     }

//     public function orders()
//     {
//         return $this->belongsToMany(Order::class, 'order_products');
//     }
    
//     public function setDiscountPriceAttribute($value)
//     {
//         if($value != null && $value > 0){
//             $percentage = str_replace("","%",$value);
//             $discount_price = $this->attributes['price'] * $percentage / 100;
//             $this->attributes['discount_price'] = round($this->attributes['price'] - $discount_price, 2);
//         }else{
//             $this->attributes['discount_price'] = null;
//         }
// }

//     public function setPriceAttribute($value)
//     {
//             $this->attributes['price'] = round($value, 2);
//     }

//     public function getDiscountRateAttribute()
//     {
//         if($this->attributes['discount_price'] != null && $this->attributes['discount_price'] > 0){
//         $discount = $this->attributes['price'] - $this->attributes['discount_price'];
//         $discount_rate = $discount / $this->attributes['price'];
//         return round((float)$discount_rate * 100);
//     }
// }

//     public function getNameAttribute()
//     {
//         return $this->name_ar;
//     }
//     public function getDetailsAttribute()
//     {
//         return $this->details_ar;
//     }
//     public function getPriceAttribute($value)
//     {
//         return $this->discount_price ?? $value;
//     }

}
