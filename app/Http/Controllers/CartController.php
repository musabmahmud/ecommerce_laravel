<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => ['required','min:1'],
        ]);
        
        $product = Product::findOrFail($request->product_id);
        
        if ($request->hasCookie('ecom_laravel')) {

            $cookie_id = $request->cookie('ecom_laravel');

            if(Cart::where('cookie_id',$cookie_id)->where('product_id',$request->product_id)->exists()){
                return redirect('product-details/'.$product->product_slug.'/#alreadyAdded')->with('error','Already Added To Cart');
            }
            else{
                $cart = new Cart();
                $cart->cookie_id = $cookie_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->quantity;
                $cart->offer_price = $request->offer_price;
                $cart->save();
                return redirect('product-details/'.$product->product_slug.'/#alreadyAdded')->with('success','Added To Cart');
            }
        }
        else {
            $cookie_id = Cookie::queue('ecom_laravel', Str::random(15), 43200);

            $cart = new Cart();
            $cart->cookie_id = $cookie_id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->offer_price = $request->offer_price;
            $cart->save();
            return back()->with('success','Added To Cart');
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function cartUpdate(Request $request)
    {
        $request->validate([
            'quantity' => ['required'],
            'quantity.*' => ['required'],
        ]);

        foreach($request->cart_id as $key => $cartId){
            $cart = Cart::findOrFail($cartId);
            $cart->quantity = $request->quantity[$key];
            $cart->save();
        }
        return redirect('cart/#cartupdate')->with('success', 'Cart Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function cartDestroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return back()->with('success', 'Cart Updated Successfully');
    }
}
