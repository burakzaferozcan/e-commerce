<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class AjaxController extends Controller
{
    public function contact_save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ], [
            'name.required' => 'İsim Soyisim Zorunlu',
            'name.string' => 'İsim Soyisim Karakterlerden oluşmalı',
            'name.min' => 'İsim Soyisim Minimum 3 karakterden olmalıdır.',
            'email.required' => 'E-posta zorunlu',
            'email.email' => 'Geçersiz bir email adresi',
            'subject.required' => 'Konu kısmı boş geçilemez',
            'message.required' => 'Mesaj kısmı boş geçilemez',
        ]);

        $data = $request->all();
        $data["ip"] = $request->ip();
        Contact::create($data);

        return back()->withSuccess("Mesajınız Başarıyla Gönderildi.");

    }
}
