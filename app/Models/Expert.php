<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function status()
    {
        return $this->status == 0 ?  __('Inactive') : __('Active');
    }

    public function gender()
    {
        return $this->status == 0 ?  __('Female') : __('Male');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
