<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function indexView(){
    $categories =  Category::latest()->get();
    $products =  Product::latest()->get();
    return view('layouts.index',compact('categories','products'));
    }
}
