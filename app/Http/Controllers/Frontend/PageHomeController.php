<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class PageHomeController extends Controller
{
    public function index()
    {
        $slider = Slider::where("status", "1")->first();
        $title = "Anasayfa";
        return view("frontend.pages.index", compact("slider", "title"));
    }
}
