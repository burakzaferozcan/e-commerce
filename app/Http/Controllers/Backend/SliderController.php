<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders=Slider::all();
        return view("backend.pages.slider.index",compact("sliders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.pages.slider.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {

        if($request->hasFile("image")){
            $image=$request->file("image");
            $fileName=$request->name;
            $uplaodFolder="img/slider/";
            $imageUrl =resimyukle($image,$fileName,$uplaodFolder);
        }

         Slider::create([
            'name'=>$request->name,
            'link'=>$request->link,
            'status'=>$request->status,
            'content' => $request->input('content'),
            "image"=>$imageUrl??NULL,
        ]);

        return back()->withSuccess('Başarıyla Oluşturuldu!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider=Slider::where('id', $id)->first();
        return view("backend.pages.slider.create",compact("slider"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider=Slider::where("id",$id)->firstOrFail();
        if($request->hasFile("image")){
            dosyasil($slider->image);

            $image=$request->file("image");
            $fileName=$request->name;
            $uplaodFolder="img/slider/";
            $imageUrl =resimyukle($image,$fileName,$uplaodFolder);
        }

        $slider =  Slider::where('id',$id)->update([
            'name'=>$request->name,
            'link'=>$request->link,
            'status'=>$request->status,
            'content' => $request->input('content'),
            "image"=>$imageUrl??NULL,
        ]);

        return back()->withSuccess('Başarıyla Güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $slider=Slider::where('id', $request->id)->firstOrFail();

        dosyasil($slider->image);
        $slider->delete();
        return response(['error'=>false,'message'=>'Başarıyla Silindi.']);
    }

    public function status(Request $request) {

        $update = $request->statu;
        $updatecheck = $update == "false" ? '0' : '1';
        Slider::where('id',$request->id)->update(['status'=> $updatecheck]);
        return response(['error'=>false,'status'=>$update]);
    }
}
