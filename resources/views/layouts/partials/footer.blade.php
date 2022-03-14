<footer class="footer-area">
    <div class="footer-top-area bg-img pt-105 pb-65" data-overlay="9">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-3">
                    <div class="footer-widget mb-40">
                        <h3 class="footer-widget-title">Features</h3>
                        <div class="footer-widget-content">
                            <ul>
                                <li><a href="{{ url('cart') }}">Cart</a></li>
                                <li><a href="{{ url('account') }}">My Account</a></li>
                                <li><a href="{{ url('login') }}">Login</a></li>
                                <li><a href="{{ url('register') }}">Register</a></li>
                                <li><a href="{{ url('orders') }}">My Orders</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-3">
                    <div class="footer-widget mb-40">
                        <h3 class="footer-widget-title">Categories</h3>
                        <div class="footer-widget-content">
                            <ul>
                                @foreach (random_categories() as $category)
                                    <li><a
                                            href="{{ url("products?categories_id=$category->id") }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="footer-widget mb-40">
                        <h3 class="footer-widget-title">Contact</h3>
                        <div class="footer-newsletter">
                            <p>{{ get_setting('contact_description') }}</p>
                            <div class="footer-contact mt-4">
                                <p><span><i class="ti-location-pin"></i></span> {{ get_setting('contact_address') }}
                                </p>
                                <p><span><i class=" ti-headphone-alt "></i></span> {{ get_setting('contact_telp') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom black-bg ptb-20">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="copyright">
                        <p>
                            Copyright ©
                            <a href="{{ url('/') }}">{{ get_setting('appname') }}</a>
                            {{ date('Y') }} .
                            All Right Reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
