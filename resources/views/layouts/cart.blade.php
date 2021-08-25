@extends('master')
@section('content')
    <!-- Breadcrumb Section Begin -->
   <section class="breadcrumb-section set-bg" data-setbg="{{asset('frontend')}}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad" id="cartupdate">
        <div class="container">
            <form action="{{route('cartUpdate')}}" method="POST">
                @csrf
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (cart_product() as $cartItem)
                                <input type="hidden" name="cart_id[]" value="{{$cartItem->id}}">
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{asset('frontend/img/product/'.$cartItem->product->thumbnail)}}" height="80" alt="{{$cartItem->product->product_name}}">
                                        <h5>{{$cartItem->product->product_name}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{$cartItem->product->offer_price}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        @error('quantity')
                                            <div class='text-danger'>{{$message}}<span class="text-danger">*</span></div>
                                        @enderror
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" name="quantity[]" value="{{$cartItem->quantity}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ${{$cartItem->product->offer_price * $cartItem->quantity}}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="{{route('cartDestroy',$cartItem->id)}}"><span class="icon_close text-danger"></span></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="50">No Data Available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <button class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</button>
                    </div>
                </div>
            </form>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>${{cart_total()}}</span></li>
                            <li>Total <span>$454.98</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection