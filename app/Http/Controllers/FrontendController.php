<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function indexView(){
    $categories =  Category::orderBy('category_name','Asc')->latest()->get();
    $products =  Product::orderBy('product_name','Asc')->latest()->get();
    $categories_item =  Product::orderBy('category_id','Asc')->latest()->limit(10)->get();
    $featured_cat =  Category::limit(5)->get();
    return view('layouts.index',compact('categories','products','categories_item','featured_cat'));
    }
}
