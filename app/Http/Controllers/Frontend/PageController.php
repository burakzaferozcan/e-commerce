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
    public function products(Request $request, $slug = null)
    {
        $category = request()->segment(1) ?? "";
        $sizes =!empty($request->size)? explode(",",$request->size) : null;
        $colors =!empty($request->color)? explode(",",$request->color) : null;
        $startPrice = $request->min ?? null;
        $endPrice = $request->max ?? null;
        $order = $request->order ?? "id";
        $sort = $request->sort ?? "desc";



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

        return view("frontend.pages.products", compact((["products", "maxprice", "sizeList", "colors"])));
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
