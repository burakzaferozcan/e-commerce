<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItem=session("cart",[]);
        $totalPrice=0;
        foreach ($cartItem as $cart){
            $totalPrice+=$cart['price'] * $cart["qty"];
        }
        return view("frontend.pages.cart",compact("cartItem","totalPrice"));
    }
    public function add(Request $request){
        $productID=$request->product_id;
        $qty=$request->qty??1;
        $size=$request->size;
        $urun =Product::find($productID);

        if(!$urun){
            return back()->withError('Ürün Bulunamadı!');
        }

        $cartItem=session("cart",[]);

        if(array_key_exists($productID,$cartItem)){
            $cartItem[$productID]["qty"]+=$qty;

        }else{
            $cartItem[$productID]=[
                "image"=>$urun->image,
                "name"=>$urun->name,
                "price"=>$urun->price,
                "qty"=>$urun->qty,
                "size"=>$urun->size,
                ];
        }

        $cartItem=session(["cart"=>$cartItem]);
        return back()->withSuccess('Ürün Sepete Eklendi!');


        return $request->all();
    }
    public function remove(Request $request){
        $productID=$request->product_id;
        $cartItem=session("cart",[]);
        if(array_key_exists($productID,$cartItem)){
            unset($cartItem[$productID]);
        }
        session(["cart"=>$cartItem]);
        return back()->withSuccess("Ürün Başarıyla Sepetten Kaldırıldı.");
    }

}
