<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ParentCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    // protected $appends = ["name"];

    // public function getNameAttribute() 
    // {
    //     return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;

    // }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }


}
