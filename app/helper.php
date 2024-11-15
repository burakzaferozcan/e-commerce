<?php

if(!function_exists("dosyasil")){
    function dosyasil($string)
    {
        if(file_exists($string)){
            if(!empty($string)){
                unlink($string);
            }
        }
    }

}

if (!function_exists('resimyukle')) {
    function resimyukle($image,$name,$yol) {
        $uzanti = $image->getClientOriginalExtension();
        $dosyadi = time().'-'.\Illuminate\Support\Str::slug($name);
        if($uzanti == 'pdf' ||  $uzanti == 'svg' ||  $uzanti == 'webp' ||  $uzanti == 'jiff') {
            $image->move(public_path($yol),$dosyadi.'.'.$uzanti);
            $imageurl = $yol.$dosyadi.'.'.$uzanti;
        }else {
            $image = \Intervention\Image\Facades\Image::make($image);
            $image->encode('webp', 75)->save($yol.$dosyadi.'.webp');
            $imageurl = $yol.$dosyadi.'.webp';
        }
        return  $imageurl;
    }
}

if (!function_exists('strLimit')) {
    function strLimit($text, $limit, $url = null) {
        if ($url == null) {
            $end = '...';
        } else {
            $end = '<a class="ml-2" href="' . $url . '">[...]</a>';
        }
        return Str::limit($text, $limit, $end);
    }
}

if(!function_exists('klasorac')){
    function klasorac($dosyayol,$izinler=0777)
{
    if (!file_exists($dosyayol)){
        mkdir($dosyayol,$izinler,true);
    }
}
}
