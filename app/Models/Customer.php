<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Customer extends Authenticatable  
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    public $append = ['full_name'];


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'customer_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function createOTPCode()
    {
        $this->timestamps = false;
        $this->code = /*Hash::make(*/rand(1111, 9999)/*)*/;
        $this->code_expire = now()->addMinute(10);
        $this->save();

    }

}
