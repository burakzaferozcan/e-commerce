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
            $extension=$image->getClientOriginalExtension();
            $fileName=time()."-".Str::slug($request->name);
            $uplaodFolder="img/slider/";

            if($extension=="pdf"||$extension=="svg"||$extension=="webp"){
                $image->move(public_path($uplaodFolder),$fileName.".".$extension);
                $imageUrl=$uplaodFolder.$fileName.'.'.$extension;
            }else{
                $image= Image::make($image);
                $image->encode("webp",75)->save($uplaodFolder.$fileName.".webp");
                $imageUrl=$uplaodFolder.$fileName.'.webp';

            }
        }
        $slider =  Slider::create([
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
        if($request->hasFile("image")){
            $image=$request->file("image");
            $extension=$image->getClientOriginalExtension();
            $fileName=time()."-".Str::slug($request->name);
            $uplaodFolder="img/slider/";

            if($extension=="pdf"||$extension=="svg"||$extension=="webp"){
                $image->move(public_path($uplaodFolder),$fileName.".".$extension);
                $imageUrl=$uplaodFolder.$fileName.'.'.$extension;
            }else{
                $image= Image::make($image);
                $image->encode("webp",75)->save($uplaodFolder.$fileName.".webp");
                $imageUrl=$uplaodFolder.$fileName.'.webp';

            }
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
    public function destroy(string $id)
    {
        //
    }
}
