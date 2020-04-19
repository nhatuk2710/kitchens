@extends('layouts')
@section('banner')
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form method="post" action="{{url("check-out")}}" class="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Biiling Details</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="fir">Customer name<span>*</span></label>
                                <input name="customer_name" type="text" id="fir">
                            </div>
                            <div class="col-lg-12">
                                <label for="cun-name">Telephone</label>
                                <input type="number" name="telephone" id="cun-name">
                            </div>
                            <div class="col-lg-12">
                                <label for="cun">Shipping adress<span>*</span></label>
                                <input type="text" name="shipping_address" id="cun">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                        @foreach($cart as $k)
                                        <li class="fw-normal">{{$k->product_name}} x {{$k->cart_qty}}<span>{{$k->price}}</span></li>
                                            @php $cart_total+=($k->price*$k->cart_qty) @endphp
                                        @endforeach
                                    <li class="total-price">Total<span>${{number_format($cart_total,2)}}</span></li>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            Cheque Payment
                                            <input name="payment_method" type="checkbox" value="Cheque Payment" id="pc-check">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            <span>Paypal</span>
                                            <input name="payment_method" type="checkbox" value="Paypal" id="pc-paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @endsection
