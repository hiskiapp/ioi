<header>
    <div class="header-top-furniture wrapper-padding-2 res-header-sm">
        <div class="container-fluid">
            <div class="header-bottom-wrapper">
                <div class="logo-2 furniture-logo ptb-30">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset(get_setting('logo')) }}" alt="">
                    </a>
                </div>
                <div class="menu-style-2 furniture-menu menu-hover">
                    <nav>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="{{ url('products') }}">products</a></li>
                            @auth
                                <li><a href="{{ url('orders') }}"> Orders </a></li>
                                <li><a href="{{ url('account') }}"> My Account </a></li>
                            @endauth
                        </ul>
                    </nav>
                </div>
                @if (auth()->check())
                    <div class="header-cart">
                        <a class="icon-cart-furniture" href="#">
                            <i class="ti-shopping-cart"></i>
                            <span class="shop-count-furniture green">{{ count(cart_items()) }}</span>
                        </a>
                        <ul class="cart-dropdown">
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach (cart_items() as $item)
                                @php
                                    $subtotal += $item->products_price * $item->total_order;
                                @endphp
                                <li class="single-product-cart">
                                    <div class="cart-img">
                                        <a href="{{ url("products/$item->products_permalink") }}"><img
                                                src="{{ asset($item->products_image) }}"
                                                alt="{{ $item->products_name }}" width="85px"></a>
                                    </div>
                                    <div class="cart-title">
                                        <h5><a href="#"> {{ $item->products_name }}</a></h5>
                                        <span>{{ format_currency($item->products_price) }} x
                                            {{ $item->total_order }}</span>
                                    </div>
                                    <div class="cart-delete">
                                        <a href="javascript:void(0);" onclick="event.preventDefault();
                                    document.getElementById('destroy_cart_{{ $item->id }}').submit();"><i
                                                class="ti-trash"></i></a>
                                        <form id="destroy_cart_{{ $item->id }}"
                                            action="{{ url("cart/$item->id") }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            @method('DELETE')

                                        </form>
                                    </div>
                                </li>
                            @endforeach
                            <li class="cart-space">
                                <div class="cart-sub">
                                    <h4>Subtotal</h4>
                                </div>
                                <div class="cart-price">
                                    <h4>{{ format_currency($subtotal) }}</h4>
                                </div>
                            </li>
                            <li class="cart-btn-wrapper">
                                <a class="cart-btn btn-hover" href="{{ url('cart') }}">view cart</a>
                                <a class="cart-btn btn-hover" href="{{ url('checkout') }}">checkout</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="{{ url('/') }}">HOME</a></li>
                                <li><a href="{{ url('products') }}"> Products </a></li>
                                @auth
                                    <li><a href="{{ url('orders') }}"> Orders </a></li>
                                    <li><a href="{{ url('account') }}"> My Account </a></li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom-furniture wrapper-padding-2 border-top-3">
        <div class="container-fluid">
            <div class="furniture-bottom-wrapper">
                <div class="furniture-login">
                    <ul>
                        @if (auth()->check())
                            <li>Hi <b>{{ auth()->user()->name }}</b>!</li>
                            <li>Get Access: <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">Logout </a></li>
                        @else
                            <li>Get Access: <a href="{{ route('login') }}">Login </a></li>
                            <li><a href="{{ route('register') }}">Register </a></li>
                        @endif

                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <div class="furniture-search">
                    <form action="products">
                        <input name="q" placeholder="Search . . . ." type="text">
                        <button>
                            <i class="ti-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
