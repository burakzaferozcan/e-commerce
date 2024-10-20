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
    public function products(Request $request)
    {
        $size = $request->size ?? null;
        $color = $request->color ?? null;
        $startPrice = $request->start_price ?? null;
        $endPrice = $request->end_price ?? null;



        $products = Product::where("status", "1")->where(function ($q) use ($size, $color, $startPrice, $endPrice) {
            if (!empty($size)) {
                $q->where("size", $size);
            }if (!empty($color)) {
                $q->where("color", $color);
            }if (!empty($startPrice) && !empty($endPrice)) {
                $q->whereBetween("price", [$startPrice, $endPrice]);
            }
            return $q;

        })->paginate(1);

        $categories = Category::where("status", "1")
            ->where("cat_ust", null)
            ->withCount("items")
            ->get();
        return view("frontend.pages.products", compact((["products", "categories"])));
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
