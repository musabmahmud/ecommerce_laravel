<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function indexView(){
        $products =  Product::orderBy('product_name','Asc')->latest()->get();
        $categories_item =  Product::orderBy('category_id','Asc')->latest()->limit(10)->get();
        $featured_cat =  Category::limit(5)->get();
        $latest_product = Product::latest()->limit(12)->get();
        return view('layouts.index',compact('products','categories_item','featured_cat','latest_product'));
    }

    function productDetails($product_slug){
        $productDetails =  Product::where('product_slug',$product_slug)->first();
        $relatedProducts =  Product::where('category_id',$productDetails->category_id)->limit(8)->get();
        return view('layouts.product_details',compact('productDetails','relatedProducts'));
    }
}
