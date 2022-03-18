@extends('layouts.app')
@section('title', $product->name)
@section('content')
    @include('layouts.partials.breadcumb', [
        'bg' => get_setting('breadcum_products'),
        'parent' => 'Products',
    ])
    <div class="product-details ptb-100 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-12">
                    <div class="product-details-img-content">
                        <div class="product-details-tab mr-70">
                            <div class="product-details-large tab-content">
                                @foreach ($product->images as $image)
                                    @if ($loop->first)
                                        <div class="tab-pane active show fade" id="pro-details{{ $loop->iteration }}"
                                            role="tabpanel">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="{{ asset($image) }}">
                                                    <img src="{{ asset($image) }}" alt="{{ $product->name }}"
                                                        style="max-width: 600px !important">
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="tab-pane fade" id="pro-details{{ $loop->iteration }}" role="tabpanel">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="{{ asset($image) }}">
                                                    <img src="{{ asset($image) }}" alt="{{ $product->name }}"
                                                        style="max-width: 600px !important">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="product-details-small nav mt-12" role=tablist>
                                @foreach ($product->images as $image)
                                    @if ($loop->first)
                                        <a class="active mr-12" href="#pro-details{{ $loop->iteration }}"
                                            data-bs-toggle="tab" role="tab" aria-selected="true">
                                            <img src="{{ asset($image) }}" alt="{{ $product->name }}"
                                                style="width: 141px !important">
                                        </a>
                                    @else
                                        <a class="mr-12" href="#pro-details{{ $loop->iteration }}"
                                            data-bs-toggle="tab" role="tab" aria-selected="true">
                                            <img src="{{ asset($image) }}" alt="{{ $product->name }}"
                                                style="width: 141px !important">
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-12">
                    <div class="product-details-content">
                        <h3>{{ $product->name }}</h3>
                        <div class="details-price">
                            <span>{{ format_currency($product->price) }}</span>
                        </div>
                        <p>{!! $product->description !!}</p>
                        <div class="quickview-plus-minus">
                            <div style="width: 80px">
                                <input value="1" type="number" name="qty_input" min="1" max="{{ $product->stock }}"
                                    class="items-total" required>
                            </div>
                            <div class="quickview-btn-cart">
                                <a @disabled(true) class="btn-hover-black" href="javascript:void(0);"
                                    onclick="event.preventDefault();document.getElementById('product_add').submit();">add
                                    to cart</a>
                                <form id="product_add" action="{{ route('cart.add', $product->id) }}" method="POST"
                                    class="d-none">
                                    @csrf
                                    <input type="hidden" name="qty" value="1">
                                </form>
                            </div>
                        </div>
                        <div class="product-details-cati-tag mt-35">
                            <ul>
                                <li class="categories-title">Location :</li>
                                <li>{{ $product->location }}</li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Size :</li>
                                <li>{{ $product->size }}</li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Stock :</li>
                                <li>{{ $product->stock }}</li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Categories :</li>
                                <li><a
                                        href="{{ route('products.index', ['categories_id' => $product->categories_id]) }}">{{ $product->categories_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="product-share mt-35">
                            <ul>
                                <li class="categories-title">Share :</li>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('product.show', $product->permalink)) }}"
                                        target="_blank">
                                        <i class="icofont icofont-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://twitter.com/share?url={{ urlencode(route('product.show', $product->permalink)) }}"
                                        target="_blank">
                                        <i class="icofont icofont-social-twitter"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product area start -->
    @if ($related_products->count() > 0)
        <div class="product-area pb-95">
            <div class="container">
                <div class="section-title-3 text-center mb-50">
                    <h2>Related products</h2>
                </div>
                <div class="product-style">
                    <div class="related-product-active owl-carousel">
                        @foreach ($related_products as $product)
                            <div class="product-wrapper">
                                <div class="product-img">
                                    <a href="{{ route('product.show', $product->permalink) }}">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                            style="max-width: 300px !important">
                                    </a>
                                    <div class="product-action">
                                        <a class="animate-left" title="Add To Cart" href="javascript:void(0);"
                                            onclick="event.preventDefault();document.getElementById('product_{{ $loop->iteration }}').submit();">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <form id="product_{{ $loop->iteration }}"
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
                                <div class="product-content">
                                    <h4><a
                                            href="{{ route('product.show', $product->permalink) }}">{{ $product->name }}</a>
                                    </h4>
                                    <span>{{ format_currency($product->price) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @push('js')
        <script>
            $(function() {
                $('input[name="qty_input"]').on('change', function(e) {
                    var max = parseInt($(this).attr('max'));
                    var min = parseInt($(this).attr('min'));
                    var this_val = $(this).val();
                    if ($(this).val() > max) {
                        $(this).val(max);
                        this_val = max;
                    } else if ($(this).val() < min) {
                        $(this).val(min);
                        this_val = min;
                    }

                    $('input[name="qty"]').val(this_val);
                });
            });
        </script>
    @endpush
@endsection
