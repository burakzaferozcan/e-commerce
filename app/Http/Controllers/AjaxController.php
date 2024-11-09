<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentFormRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function contact_save(ContentFormRequest $request)
    {

        $newdata =[
            'name'=> Str::title($request->name),
            'email'=> $request->email,
            'subject'=> $request->subject,
            'message'=> $request->message,
            'ip'=> request()->ip(),
        ];

        $sonkaydedilen =  Contact::create($newdata);

        return back()->with(['message'=>'Başarıyla Gönderildi']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
