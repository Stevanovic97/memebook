<?php

namespace App;

use Image;

final class ImageHelper 
{
    public static function CreateImage($img_name, $img_path)
    {
        $img = Image::make($img_name);
        $img_name = "/" . time() . "_" . $img_name->getClientOriginalExtension();
        $path = public_path($img_path);
        $img->save($path . $img_name);

        return $img_name;
    }
}