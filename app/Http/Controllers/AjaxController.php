<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function contact_save(Request $request)
    {
        $data = $request->all();
        $data["ip"] = $request->ip();
        Contact::create($data);
        return back()->withSuccess("Mesajınız Başarıyla Gönderildi.");

    }
}
