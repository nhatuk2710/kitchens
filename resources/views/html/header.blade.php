<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    hello.colorlib@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +65 11.188.888
                </div>
            </div>
            <div class="ht-right">
                <a href="{{asset("/login")}}" class="login-panel"><i class="fa fa-user"></i>Login</a>
                <a href="{{asset("/logout")}}" class="login-panel">Logout</a>
                <div class="lan-selector">
                    <select class="language_drop" style="width:300px;">
                        <option value='yt' data-image={{asset("img/flag-1.jpg")}} data-imagecss="flag yt
                                data-title="English">English</option>
                        <option value='yu' data-image={{asset("img/flag-2.jpg")}} data-imagecss="flag yu
                                data-title="Bangladesh">German </option>
                    </select>
                </div>
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{url("/")}}">
{{--                            <img src="{{asset("img/logo.png")}}" alt="">--}}
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <button type="button" class="category-btn">All Categories</button>
                        <div class="input-group">
                            <input type="text" placeholder="What do you need?">
                            <button type="button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    @php $cart= session("cart") @endphp
                    @if(isset($cart))
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="{{url("/cart")}}">
                                    <i class="icon_bag_alt"></i>
                                    <span>{{count($cart)}}</span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                            @foreach($cart as $c)
                                            <tr>
                                                <td class="si-pic"><img src="{{asset("$c->thumbnail")}}" alt="" style="width: 70px;height: 70px"></td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p>${{$c->getPrice()}} x {{$c->cart_qty}}</p>
                                                        <h6>{{$c->product_name}}</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <a href="{{url("/deleteItemCart/{$c->id}")}}"> <i class="ti-close"></i></a>
                                                </td>
                                            </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>$120.00</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                        <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">$150.00</li>
                        </ul>

                    @else
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="{{url("/cart")}}">
                                    <i class="icon_bag_alt"></i>
                                    <span>0</span>
                                </a>
                            </li>
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="ti-menu"></i>
                    <span>All departments</span>
                    <ul class="depart-hover">
                        @foreach(\App\Category::all() as $c)
                        <li class="active"><a href="{{url("listingcate/{$c->id}")}}">{{$c->category_name}}</a></li>
                            @endforeach
                    </ul>
                </div>
            </div>
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="active"><a href="./index.html">Home</a></li>
                    <li><a href="./shop.html">Shop</a></li>
                    <li><a href="#">Brand</a>
                        <ul class="dropdown">
                            @foreach(\App\Brand::all() as $c)
                                <li><a href="{{url("listingbrand/{$c->id}")}}">{{$c->brand_name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="./blog.html">Blog</a></li>
                    <li><a href="./contact.html">Contact</a></li>
                    <li><a href="#">Pages</a>
                        <ul class="dropdown">
                            <li><a href="./blog-details.html">Blog Details</a></li>
                            <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                            <li><a href="./check-out.html">Checkout</a></li>
                            <li><a href="./faq.html">Faq</a></li>
                            <li><a href="./register.html">Register</a></li>
                            <li><a href="./login.html">Login</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>
