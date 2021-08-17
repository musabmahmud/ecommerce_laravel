<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.brand.index',[
            'brands' => Brand::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
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
            'brand_name' => ['required','min:3','unique:brands'],
            'slug' => ['required'],
        ]);

        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->slug = $request->slug;
        $brand->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {   
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        return view('backend.brand.edit',[
            'brand' => Brand::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Brand  $brand)
    {   
        $request->validate([
            'brand_name' => ['required'],
            'slug' => ['required'],
        ]);
        $brand->brand_name = $request->brand_name;
        $brand->slug = Str::slug($request->slug);
        $brand->save();
        return back()->with('success','Brand Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Brand $brand)
    {
        $brand->delete();
        return back()->with('success','Brand Trashed Successfully');
        // if($cat->subBrand->count() == 0){
        //     Brand::findOrFail($brand)->delete();
        //     return back()->with('success','Brand Trashed Successfully');
        // }
        // else{
        //     return back()->with('error','Brand has Sub Brand');
        // }
    }
    public function brandtrashed(){
        return view('backend.Brand.trashed',[
            'brands' => Brand::onlyTrashed()->paginate(10)
        ]);
    }
    function restorebrand($id){
        Brand::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','Brand Restored Successfully');
    }

    function branddeleteforever($id){
        Brand::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success','Brand Permanently Deleted Successfully');
    }
}
