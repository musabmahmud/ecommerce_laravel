<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.product.index', [
            'products' => Product::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create', [
            'categories' => Category::orderBy('category_name', 'Asc')->get(),
            'brands' => Brand::orderBy('brand_name', 'Asc')->get(),
        ]);
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
            'product_name' => ['required', 'min:3', 'unique:products'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'quantity' => ['required'],
            'weight' => ['required'],
            'thumbnail' => 'required | mimes:jpeg,jpg,png',

            'gallery' => ['mimes:jpeg,jpg,png,gif|required'],
            'gallery.*' => ['mimes:jpeg,jpg,png,gif|required'],

            'price' => ['required'],
            'summary' => ['required', 'max:500'],
            'description' => ['required'],
        ]);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_slug = $request->product_slug;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->summary = $request->summary;
        $product->description = $request->description;

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $ext = Str::random(5) . '-' . $request->product_slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('frontend/img/product/' . $ext), 72);
            $product->thumbnail = $ext;
        }

        $product->save();

        if ($request->hasFile('image_name')) {
            $image = $request->file('image_name');
            foreach ($image as $key => $value) {
                $gallery = new Gallery();
                $extgallery = Str::random(10) . '-' . $request->product_slug . '.' . $value->getClientOriginalExtension();
                Image::make($value)->save(public_path('frontend/img/product/gallery/' . $extgallery), 72);
                $gallery->image_name = $extgallery;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }

        return back()->with('success', 'Data Inserted Successfully');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Product  $Product
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Product $Product)
    // {   
    // }
    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Product  $Product
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {
        return view('backend.product.edit', [
            'product' => Product::findOrFail($id),
            'categories' => Category::orderBy('category_name', 'Asc')->get(),
            'brands' => Brand::orderBy('brand_name', 'Asc')->get(),
        ]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Product  $Product
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, Product  $product)
    {
        $request->validate([
            'product_name' => 'unique:products,product_name,' . $product->id,
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'quantity' => ['required'],
            'weight' => ['required'],

            'price' => ['required'],
            'summary' => ['required', 'max:500'],
            'description' => ['required'],
        ]);

        $product->product_name = $request->product_name;
        $product->product_slug = $request->product_slug;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->price = $request->price;
        $product->summary = $request->summary;
        $product->description = $request->description;


        if ($request->offer_price) {
            $product->offer_price = $request->offer_price;
        } else {
            $product->offer_price = 'NULL';
        }

        if ($request->hasFile('thumbnail')) {

            $request->validate([
                'thumbnail' => 'required | mimes:jpeg,jpg,png | max:1000',
            ]);

            $image = $request->file('thumbnail');
            $ext = Str::random(5) . '-' . $request->product_slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('frontend/img/product/' . $ext), 72);
            $product->thumbnail = $ext;
        }

        $product->save();

        return back()->with('success', 'Product Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        Product::findOrfail($product_id)->delete();
        return back()->with('success', 'Product Trashed Successfully');
    }

    
    public function producttrashed()
    {
        return view('backend.product.trashed', [
            'products' => Product::onlyTrashed()->paginate(10)
        ]);
    }
    function restoreProduct($id){
        Product::onlyTrashed()->findOrFail($id)->restore();
        Gallery::onlyTrashed()->where('product_id',$id)->restore();
        return back()->with('success','Product Restored Successfully');
    }

    function productdeleteforever($id){
        Product::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success','Product Permanently Deleted Successfully');
    }
    function productGallery($id){
        return view('backend.product.gallery_index', [
            'galleries' => Gallery::Where('product_id', $id)->latest()->paginate(20),
        ]);
    }
    function galleryDestroy($id){
        Gallery::findOrfail($id)->delete();
        return back()->with('success', 'Product Trashed Successfully');
    }
    public function galleryTrashed()
    {
        return view('backend.product.gallery_trashed', [
            'products' => Gallery::onlyTrashed()->paginate(10)
        ]);
    }
}

// $galleries = Gallery::where('product_id', $product_id)->get();

//         if($galleries->count() == 0){
//             $old_image = public_path('frontend/img/product/' . $product->thumbnail);
//             if (file_exists($old_image)) {
//                 unlink($old_image);
//             }
//             $product->delete();
//             return back()->with('success','Product Trashed Successfully');
//         }
//         else{
//             $galleries = Gallery::where('product_id', $product_id)->get();

//             $old_image = public_path('frontend/img/product/' . $product->thumbnail);
//             if (file_exists($old_image)) {
//                 unlink($old_image);
//             }
        
//             foreach($galleries as $key => $gallery){
//                 $old_gallery_image = public_path('frontend/img/product/gallery/' . $gallery->image_name[$key]);
//                 if (file_exists($old_gallery_image)) {
//                     unlink($old_gallery_image);
//                 }
//                 Gallery::findOrFail($gallery->id)->delete();
//             }
//             $product->delete();
//             return back()->with('success','Product Trashed Successfully');
//         }