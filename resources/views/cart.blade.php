@extends('layouts')
@section('banner')
    <section class="shopping-cart spad">
        <div class="container">
            <form action="{{url("/updateCart")}}" method="post">
                @csrf
            <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($cart as $p)
                                        <tr>
                                            <td class="cart-pic first-row"><img src="{{asset($p->thumbnail)}}" alt=""></td>
                                            <td class="cart-title first-row">
                                                <h5>{{$p->product_name}}</h5>
                                            </td>
                                            <td class="p-price first-row">${{$p->getprice()}}</td>
                                            <td class="qua-col first-row">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input  name="qty/{{$p->id}}" type="text" value="{{$p->cart_qty}}" min="1">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
{{--                                                <div class="product_count">--}}
{{--                                                    <button class="increase items-count" id="increaseOne" type="button">--}}
{{--                                                        <a href="{{url("/increaseOne/{$p->id}")}}"> <i class="lnr lnr-chevron-up" >+++++</i></a>--}}
{{--                                                    </button>--}}
{{--                                                    <input type="text" name="qty" maxlength="12" value="{{$p->cart_qty}}" title="Quantity:" class="input-text qty"/>--}}
{{--                                                    @if( $p->cart_qty>1)--}}
{{--                                                        <button class="reduced items-count" type="button" id="reduceOne"--}}
{{--                                                        >--}}
{{--                                                            <a  href="{{url("/reduceOne/{$p->id}")}}"> <i class="lnr lnr-chevron-down"></i>-----</a>--}}
{{--                                                        </button>--}}
{{--                                                    @else--}}
{{--                                                        <button class="reduced items-count" type="button" disabled="disabled"--}}
{{--                                                        >--}}
{{--                                                            <a > <i class="lnr lnr-chevron-down"></i></a>--}}
{{--                                                        </button>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
                                            <td class="total-price first-row">${{($p->cart_qty*$p->price)}}</td>
                                            <td class="close-td first-row"><a class="ti-close" href="{{url("/deleteItemCart/{$p->id}")}}"></a></td>
                                        </tr>
                                @empty
                                    <p>Khong co san pham</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="cart-buttons">
                                    <a href="{{url("/")}}" class="primary-btn continue-shop">Continue shopping</a>
                                    <button class="primary-btn up-cart">Update cart</button>
                                </div>
{{--                                <div class="discount-coupon">--}}
{{--                                    <h6>Discount Codes</h6>--}}
{{--                                    <form action="#" class="coupon-form">--}}
{{--                                        <input type="text" placeholder="Enter your codes">--}}
{{--                                        <a class="site-btn coupon-btn">Apply</a>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-lg-4 offset-lg-4">
                                <div class="proceed-checkout">
                                    <ul>
                                        <li class="subtotal">Subtotal <span>${{$cart_total}}</span></li>
                                        <li class="cart-total">Total <span>${{$cart_total}}</span></li>
                                    </ul>
                                    <a href="{{url("/check-out")}}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </section>
    @endsection

