<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentFormRequest;
use App\Models\Contact;
class AjaxController extends Controller
{
    public function contact_save(ContentFormRequest $request)
    {

        $data = $request->all();
        $data["ip"] = $request->ip();
        Contact::create($data);

        return back()->withSuccess("Mesajınız Başarıyla Gönderildi.");

    }
}
