<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $about = About::where("id", 1)->first();
        $breadcrumb = [
            'sayfalar' => [
            ],
            'active'=> 'Hakkımızda'
        ];

        $seolists = metaolustur('hakkimizda');

        $seo = [
            'title' =>  $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url'=>  $seolists['currenturl'],
            'canonical'=> $seolists['trpage'],
            'robots' => 'index, follow',
        ];

        return view('frontend.pages.about',compact("seo",'breadcrumb','about'));
    }
    public function contact()
    {
        $breadcrumb = [
            'sayfalar' => [
            ],
            'active'=> 'İletişim'
        ];

        $seolists = metaolustur('iletisim');

        $seo = [
            'title' =>  $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url'=>  $seolists['currenturl'],
            'canonical'=> $seolists['trpage'],
            'robots' => 'index, follow',
        ];
        return view('frontend.pages.contact',compact("seo",'breadcrumb'));
    }
    public function products(Request $request, $slug = null)
    {
        $category = request()->segment(1) ?? "";
        $sizes =!empty($request->size)? explode(",",$request->size) : null;
        $colors =!empty($request->color)? explode(",",$request->color) : null;
        $startPrice = $request->min ?? null;
        $endPrice = $request->max ?? null;
        $order = $request->order ?? "id";
        $sort = $request->sort ?? "desc";

        $anakategori = null;
        $altkategori = null;
        if(!empty($category) && empty($slug)) {
            $anakategori = Category::where('slug',$category)->first();
            $categorySlug = $anakategori->slug ?? '';
        }else if (!empty($category) && !empty($slug)){
            $anakategori = Category::where('slug',$category)->first();
            $altkategori = Category::where('slug',$slug)->first();
            $categorySlug = $altkategori->slug ?? '';
        }


        $breadcrumb = [
            'sayfalar' => [

            ],
            'active'=> 'Ürünler'
        ];

        if(!empty($anakategori) && empty($altkategori)) {
            $breadcrumb['active'] = $anakategori->name;
        }

        if(!empty($altkategori)) {
            $breadcrumb['sayfalar'][] = [
                'link'=> route($anakategori->slug.'_products'),
                'name' => $anakategori->name
            ];

            $breadcrumb['active'] = $altkategori->name;
        }

        $products = Product::where("status", "1")
            ->select(["id", "name", "slug", "size", "color", "price", "category_id", "image"])
            ->where(function ($q) use ($sizes, $colors, $startPrice, $endPrice) {
                if (!empty($sizes)) {
                    $q->whereIn("size", $sizes);
                }if (!empty($colors)) {
                    $q->whereIn("color", $colors);
                }if (!empty($startPrice) && !empty($endPrice)) {
                    $q->where('price','>=', $startPrice);
                    $q->where('price','<=', $endPrice);
                }
                return $q;

            })
            ->with("category:id,name,slug")
            ->whereHas("category", function ($q) use ($category, $slug) {
                if (!empty($slug)) {
                    $q->where("slug", $slug);
                }
                return $q;
            })->orderBy($order, $sort)->paginate(21);

        if($request->ajax()){
            $view = view("frontend.ajax.productList",compact("products"))->render();
            return response(["data"=>$view,"paginate"=>(string)$products->withQueryString()->links('vendor.pagination::bootstrap-4')]);
        }

        $sizeList = Product::where("status", "1")->groupBy("size")->pluck("size")->toArray();
        $colors = Product::where("status", "1")->groupBy("color")->pluck("color")->toArray();

        $maxprice=Product::max("price");

        $seolists = metaolustur($category);

        $seo = [
            'title' =>  $seolists['title'] ?? '',
            'description' => $seolists['description'] ?? '',
            'keywords' => $seolists['keywords'] ?? '',
            'image' => asset('img/page-bg.jpg'),
            'url'=>  $seolists['currenturl'],
            'canonical'=> $seolists['trpage'],
            'robots' => 'index, follow',
        ];

        return view("frontend.pages.products", compact((["seo","breadcrumb","products", "maxprice", "sizeList", "colors"])));
    }
    public function sale_products()
    {
        $breadcrumb = [
            'sayfalar' => [
            ],
            'active'=> 'İndirimli Ürünler'
        ];
        return view('frontend.pages.products',compact('breadcrumb'));
    }
    public function product_detail($slug)
    {
        $product = Product::whereSlug($slug)->where("status", "1")->firstOrFail();
        $products = Product::where("id", "!=", $product->id)
            ->where("status", "1")
            ->where("category_id", $product->category_id)
            ->limit(6)->get();

        $category = Category::where('id',$product->category_id)->first();

        $breadcrumb = [
            'sayfalar' => [
            ],
            'active'=>  $product->name
        ];

        if(!empty($category)) {
            $breadcrumb['sayfalar'][] = [
                'link'=> route($category->slug.'urunler'),
                'name' => $category->name
            ];
        }

        $title =  $product->title ?? $product->name. '-'. $product->category->name. '-'. config('app.name');


        $description = 'Bu güzel '.$product->name.' ürünü '.$product->category->name.' kategorisinden bitmeden '.config('app.name'). ' hemen alın.';
        $seodesciption = $product->description ?? $description;


        $seo = [
            'title' =>   $title ?? '',
            'description' =>   $description ?? '',
            'keywords' => $product->keywords ?? '',
            'image' => asset($product->image),
            'url'=>  route('product_detail',$product->slug),
            'canonical'=> route('product_detail',$product->slug),
            'robots' => 'index, follow',
        ];


        return view('frontend.pages.product',compact("seo",'breadcrumb','product','products'));
    }

}
