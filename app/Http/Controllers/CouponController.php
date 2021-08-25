<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        return view('backend.coupon.index',[
        'coupons' => Coupon::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupon.create');
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
        'coupon_name' => ['required','min:3','unique:coupons'],
        'coupon_person' => ['required'],
        'coupon_percent' => ['required','max:100'],
        'validity_date' => ['required'],
    ]);

    $coupon = new Coupon;
    $coupon->coupon_name = $request->coupon_name;
    $coupon->coupon_person = $request->coupon_person;
    $coupon->coupon_percent = $request->coupon_percent;
    $coupon->validity_date = $request->validity_date;
    $coupon->save();

    return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.coupon.edit',[
            'coupon' => Coupon::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'coupon_name' => 'unique:products,product_name,' . $coupon->id,
            'coupon_person' => ['required'],
            'coupon_percent' => ['required','max:100'],
            'validity_date' => ['required'],
        ]);

        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_person = $request->coupon_person;
        $coupon->coupon_percent = $request->coupon_percent;
        $coupon->validity_date = $request->validity_date;
        $coupon->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->with('success','Coupon Delete Successfully');
    }
}
