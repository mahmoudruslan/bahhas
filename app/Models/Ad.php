<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function status()
    {
        return $this->status == 0 ?  __('Inactive') : __('Active');
    }
}
