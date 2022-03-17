@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="slider-area">
        <div class="slider-active owl-carousel">
            @foreach ($banners as $banner)
                <div class="single-slider-4 slider-height-6 bg-img"
                    style="background-image: url({{ asset($banner->image) }})">
                    <div class="container">
                        <div class="row">
                            <div class="ms-auto col-lg-6">
                                <div class="furniture-content fadeinup-animated">
                                    <h2 class="animated">{{ $banner->title }}</h2>
                                    <p class="animated">{{ $banner->description }}</p>
                                    <a class="furniture-slider-btn btn-hover animated"
                                        href="{{ url("products/{$banner->products_permalink}") }}">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- product area start -->
    <div class="popular-product-area wrapper-padding-3 pt-115 pb-115">
        <div class="container-fluid">
            <div class="section-title-6 text-center mb-50">
                <h2>Popular Product</h2>
                <p>{{ get_setting('popular_product') }}</p>
            </div>
            <div class="product-style">
                <div class="popular-product-active owl-carousel">
                    @foreach ($popular_products as $product)
                        <div class="product-wrapper">
                            <div class="product-img">
                                <a href="{{ url("products/{$product->permalink}") }}">
                                    <img src="{{ asset($product->image) }}" alt="">
                                </a>
                                <div class="product-action">
                                    <a class="animate-top" title="Add To Cart" href="javascript:void(0);"
                                        onclick="event.preventDefault();document.getElementById('popular_product_{{ $product->id }}').submit();">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <form id="popular_product_{{ $product->id }}"
                                        action="{{ route('cart.add', $product->id) }}" method="POST"
                                        class="d-none">
                                        @csrf

                                    </form>
                                    <a class="animate-right" title="View Product"
                                        href="{{ url("products/$product->permalink") }}">
                                        <i class="pe-7s-look"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="funiture-product-content text-center">
                                <h4><a href="#">{{ $product->name }}</a></h4>
                                <span>{{ format_currency($product->price) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- product area end -->
    <!-- product area start -->
    <div class="product-style-area pt-120">
        <div class="coustom-container-fluid">
            <div class="section-title-7 text-center">
                <h2>All Products</h2>
                <p>{{ get_setting('all_products') }}</p>
            </div>
            <div class="product-tab-list text-center mb-65 nav" role="tablist">
                @foreach ($all_products as $category)
                    <a @if ($loop->first) class="active" @endif href="#category{{ $loop->iteration }}"
                        data-bs-toggle="tab" role="tab">
                        <h4>{{ $category->name }} </h4>
                    </a>
                @endforeach
            </div>
            <div class="tab-content">
                @foreach ($all_products as $category)
                    <div class="tab-pane active show fade" id="category{{ $loop->iteration }}" role="tabpanel">
                        <div class="coustom-row-5">
                            @foreach ($category->products as $product)
                                <div class="custom-col-three-5 custom-col-style-5 mb-65">
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="{{ url("products/$product->permalink") }}">
                                                <img src="{{ asset($product->image) }}" alt="">
                                            </a>
                                            <div class="product-action">
                                                <a class="animate-top" title="Add To Cart" href="javascript:void(0);"
                                                    onclick="event.preventDefault();document.getElementById('product_{{ $product->id }}').submit();">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <form id="product_{{ $product->id }}"
                                                    action="{{ route('cart.add', $product->id) }}" method="POST"
                                                    class="d-none">
                                                    @csrf

                                                </form>
                                                <a class="animate-right" title="View Product"
                                                    href="{{ url("products/$product->permalink") }}">
                                                    <i class="pe-7s-look"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="funiture-product-content text-center">
                                            <h4><a
                                                    href="{{ url("products/$product->permalink") }}">{{ $product->name }}</a>
                                            </h4>
                                            <span>{{ format_currency($product->price) }}</span>
                                            {{-- <div class="product-rating-5">
                                                <i class="pe-7s-star black"></i>
                                                <i class="pe-7s-star black"></i>
                                                <i class="pe-7s-star"></i>
                                                <i class="pe-7s-star"></i>
                                                <i class="pe-7s-star"></i>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="view-all-product text-center">
                <a href="{{ url('products') }}">View All Product</a>
            </div>
        </div>
    </div>
    <!-- product area end -->
    @if(get_setting('show_testimonial') == 'Yes')
    <!-- testimonials area start -->
    <div class="testimonials-area pt-120 pb-115">
        <div class="container">
            <div class="testimonials-active owl-carousel">
                <div class="single-testimonial-2 text-center">
                    <h2>Testimonial</h2>
                    <p>{{ get_setting('testimonial_text') }}</p>
                    <h4>{{ get_setting('testimonial_name') }}</h4>
                    <span>{{ get_setting('testimonial_sub_name') }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonials area end -->
    @endif
    @if(get_setting('show_feature_footer') == 'Yes')
    <!-- services area start -->
    <div class="services-area wrapper-padding-4 gray-bg pt-120 pb-80">
        <div class="container-fluid">
            <div class="services-wrapper">
                <div class="single-services mb-40">
                    <div class="services-img">
                        <img src="{{ asset(get_setting('service_image_1')) }}" alt="">
                    </div>
                    <div class="services-content">
                        <h4>{{ get_setting('service_title_1') }}</h4>
                        <p>{{ get_setting('service_desc_1') }}</p>
                    </div>
                </div>
                <div class="single-services mb-40">
                    <div class="services-img">
                        <img src="{{ asset(get_setting('service_image_2')) }}" alt="">
                    </div>
                    <div class="services-content">
                        <h4>{{ get_setting('service_title_2') }}</h4>
                        <p>{{ get_setting('service_desc_2') }}</p>
                    </div>
                </div>
                <div class="single-services mb-40">
                    <div class="services-img">
                        <img src="{{ asset(get_setting('service_image_3')) }}" alt="">
                    </div>
                    <div class="services-content">
                        <h4>{{ get_setting('service_title_3') }}</h4>
                        <p>{{ get_setting('service_desc_3') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services area end -->
    @endif
@endsection
