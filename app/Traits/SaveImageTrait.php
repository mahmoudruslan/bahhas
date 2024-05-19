<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SaveImageTrait
{

    public function saveImage($folder_name, $photo)
    {
        if (!$photo) {
            return null;
        }
        $photo_name =  Str::random(3) . time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path() . '/images/' . $folder_name . '/', $photo_name);
        return $photo_name;
    }
}
