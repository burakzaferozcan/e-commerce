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

if (!function_exists('generateOTP')) {
    function generateOTP($n){
        $generator = "1357902468";
        $result = '';
        for ($i=1; $i <= $n; $i++) {
            $result .= substr($generator,(rand()%(strlen($generator))),1);
        }
        return $result;
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

if (!function_exists('sifrele')) {
    function sifrele($string){
        return encrypt($string);
    }
}

if (!function_exists('sifrelecoz')) {
    function sifrelecoz($string){
        return decrypt($string);
    }
}

if (!function_exists('ozel_path')) {
    function ozel_path($dil=null,$url=null)
    {
        if(!empty($dil) && $dil != 'tr') {
            $dillink = $dil.'.';
        }else {
            $dillink = env('APP_ENV') == 'local' ? '' : 'www.';
        }

        if(!empty($url)) {
            $urllink = '/'.$url;
        }else {
            $urllink = '';
        }

        return config('app.app_ssl').$dillink.config('app.url').$urllink;
    }
}


if (!function_exists('metaolustur')) {
    function metaolustur($page)
    {
        $pageseo = \App\Models\PageSeo::where('page', $page)->with(['images', 'pages'])->first();

        $metalar = [];
        $title = $pageseo->title;
        $description = $pageseo->description;
        $keywords = $pageseo->keywords;
        $currenturl = ozel_path(app()->getLocale(), $pageseo->page);

        foreach ($pageseo->pages as $pg) {
            $seourl = ozel_path($pg->dil, $pg->page);
            if ($pg->dil !== app()->getLocale()) {
                $metalar[] = $seourl;
            } else {
                $title = $pg->title;
                $description = $pg->description;
                $keywords = $pg->keywords;
                $currenturl = $seourl;
            }
        }

        $seoimg = collect($pageseo->images->data ?? '');
        $bgimg = $seoimg->sortByDesc('vitrin')->first()['image'] ?? '';
        $trpage = ozel_path('tr', $pageseo->page);

        $seolists = [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'currenturl' => $currenturl,
            'metalar' => $metalar,
            'bgimg' => $bgimg,
            'trpage' => $trpage,
        ];

        return $seolists;
    }
}
