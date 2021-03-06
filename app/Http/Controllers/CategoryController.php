<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.index',[
            'categories' => Category::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'category_name' => ['required','min:3','unique:categories'],
            'slug' => ['required'],
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->slug = $request->slug;
        $category->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {   
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        return view('backend.category.edit',[
            'category' => Category::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category  $category)
    {   
        $request->validate([
            'category_name' => 'unique:categories,category_name,' . $request->id,
            'slug' => ['required'],
        ]);
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->slug);
        $category->save();
        return back()->with('success','Category Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Category  $category)
    {
        $category->delete();
        return back()->with('success','Category Trashed Successfully');
        // if($cat->subcategory->count() == 0){
        //     Category::findOrFail($category)->delete();
        //     return back()->with('success','Category Trashed Successfully');
        // }
        // else{
        //     return back()->with('error','Category has Sub Category');
        // }
    }
    public function categorytrashed(){
        return view('backend.category.trashed',[
            'categories' => Category::onlyTrashed()->paginate(10)
        ]);
    }
    function restorecategory($id){
        Category::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','Category Restored Successfully');
    }

    function categorydeleteforever($id){
        Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success','Category Permanently Deleted Successfully');
    }
}
