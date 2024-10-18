<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
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
    public function products()
    {
        $products = Product::where("status", "1")->paginate(20);
        return view("frontend.pages.products", compact(("products")));
    }
    public function sale_products()
    {
        return view("frontend.pages.products");
    }
    public function product_detail()
    {
        return view("frontend.pages.product");
    }
    public function cart()
    {
        return view("frontend.pages.cart");
    }
}
