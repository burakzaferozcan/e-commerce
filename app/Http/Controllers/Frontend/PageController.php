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
        $size = $request->size ?? null;
        $color = $request->color ?? null;
        $startPrice = $request->start_price ?? null;
        $endPrice = $request->end_price ?? null;
        $order = $request->order ?? "id";
        $short = $request->short ?? "desc";



        $products = Product::where("status", "1")
            ->select(["id", "name", "slug", "size", "color", "price", "category_id", "image"])
            ->where(function ($q) use ($size, $color, $startPrice, $endPrice) {
                if (!empty($size)) {
                    $q->where("size", $size);
                }if (!empty($color)) {
                    $q->where("color", $color);
                }if (!empty($startPrice) && !empty($endPrice)) {
                    $q->whereBetween("price", [$startPrice, $endPrice]);
                }
                return $q;

            })
            ->with("category:id,name,slug")
            ->whereHas("category", function ($q) use ($category, $slug) {
                if (!empty($slug)) {
                    $q->where("slug", $slug);
                }
                return $q;
            });

        $minprice = $products->min("price");
        $maxprice = $products->max("price");
        $sizeList = Product::where("status", "1")->groupBy("size")->pluck("size")->toArray();
        $colors = Product::where("status", "1")->groupBy("color")->pluck("color")->toArray();



        $products = $products->orderBy($order, $short)->paginate(20);
        // $categories = Category::where("status", "1")
        //     ->where("cat_ust", null)
        //     ->withCount("items")
        //     ->get();
        return view("frontend.pages.products", compact((["products", "minprice", "maxprice", "sizeList", "colors"])));
    }
    public function sale_products()
    {
        return view("frontend.pages.products");
    }
    public function product_detail($slug)
    {
        $product = Product::whereSlug($slug)->first();
        return view("frontend.pages.product", compact("product"));
    }
    public function cart()
    {
        return view("frontend.pages.cart");
    }
}
