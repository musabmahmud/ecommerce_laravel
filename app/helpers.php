<?php 

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

function cart_amount(){
    $cookie = Cookie::get('ecom_laravel');
    $carts_amount = Cart::Where('cookie_id',$cookie)->count();
    return $carts_amount;
}
function cart_product(){
    $cookie = Cookie::get('ecom_laravel');
    $carts_products =  Cart::Where('cookie_id',$cookie)->get();
    return $carts_products;
}
function cart_total(){
    $cookie = Cookie::get('ecom_laravel');
    $total = 0;
    if(Cart::where('cookie_id',$cookie)->exists()){
        $carts = Cart::where('cookie_id',$cookie)->get();
        foreach($carts as $cart){
            $total = $total + $cart->quantity*$cart->offer_price;
        }
    }
    return $total;
}
?>