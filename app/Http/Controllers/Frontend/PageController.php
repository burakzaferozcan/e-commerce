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
        return view("frontend.pages.about", compact("about"));
    }
    public function contact()
    {
        return view("frontend.pages.contact");
    }
    public function urunler(Request $request,$slug=null) {


        $category = request()->segment(1) ?? null;

        $sizes = !empty($request->size) ? explode(',',$request->size) : null;

        $colors = !empty($request->color) ? explode(',',$request->color) : null;

        $startprice = $request->min ?? null;

        $endprice = $request->max ?? null;

        $order = $request->order ?? 'id';
        $sort = $request->sort ?? 'desc';


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
                'link'=> route($anakategori->slug.'urunler'),
                'name' => $anakategori->name
            ];

            $breadcrumb['active'] = $altkategori->name;
        }


        $products = Product::where('status','1')->select(['id','name','slug','size','color','price','category_id','image'])
            ->where(function($q) use($sizes,$colors,$startprice,$endprice) {
                if(!empty($sizes)) {
                    $q->whereIn('size', $sizes);
                }
                if(!empty($colors)) {
                    $q->whereIn('color', $colors);
                }

                if(!empty($startprice) && $endprice) {
                    //$q->whereBetween('price', [$startprice,$endprice]);

                    $q->where('price','>=', $startprice);

                    $q->where('price','<=', $endprice);
                }
                return $q;
            })
            ->with('category:id,name,slug')
            ->whereHas('category', function($q) use ($categorySlug) {
                if(!empty($categorySlug)) {
                    $q->where('slug', $categorySlug);
                }
                return $q;
            })
            ->with('images')
            ->orderBy($order,$sort)->paginate(21);

        if($request->ajax()) {

            $view = view('frontend.ajax.productList',compact('products'))->render();
            return response(['data'=>$view,  'paginate'=>(string) $products->withQueryString()->links('vendor.pagination.custom')]);
        }

        $sizelists =  Product::where('status','1')->groupBy('size')->pluck('size')->toArray();

        $colors =  Product::where('status','1')->groupBy('color')->pluck('color')->toArray();

        $maxprice = Product::max('price');



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


        return view('frontend.pages.products',compact('seo','breadcrumb','products','maxprice','sizelists','colors'));
    }
    public function sale_products()
    {
        return view("frontend.pages.products");
    }
    public function product_detail($slug)
    {
        $product = Product::whereSlug($slug)->where("status", "1")->firstOrFail();
        $products = Product::where("id", "!=", $product->id)
            ->where("status", "1")
            ->where("category_id", $product->category_id)
            ->limit(6)->get();
        return view("frontend.pages.product", compact(["product", "products"]));
    }

}
