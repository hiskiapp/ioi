@extends('layouts.app')
@section('title', 'Products')
@section('content')
    @include('layouts.partials.breadcumb', ['bg' => get_setting('breadcum_products')])
    <div class="shop-page-wrapper shop-page-padding ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar mr-50">
                        <div class="sidebar-widget mb-50">
                            <h3 class="sidebar-title">Search Products</h3>
                            <div class="sidebar-search">
                                <form action="{{ route('products.index') }}">
                                    <input placeholder="Search Products..." type="text" name="q"
                                        value="{{ g('q') }}">
                                    <button><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-45">
                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-categories">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a
                                                href="{{ route('products.index', ['categories_id' => $category->id, 'q' => g('q'), 'sort' => g('sort')]) }}">{{ $category->name }}
                                                <span>{{ $category->total_products }}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-50">
                            <h3 class="sidebar-title">Top products</h3>
                            <div class="sidebar-top-rated-all">
                                @foreach ($popular_products as $product)
                                    <div class="sidebar-top-rated mb-30">
                                        <div class="single-top-rated">
                                            <div class="top-rated-img">
                                                <a href="{{ route('product.show', $product->permalink) }}"><img
                                                        src="{{ asset($product->image) }}" alt="" width="91px"></a>
                                            </div>
                                            <div class="top-rated-text">
                                                <h4><a
                                                        href="{{ route('product.show', $product->permalink) }}">{{ $product->name }}</a>
                                                </h4>
                                                <div class="top-rated-rating">
                                                </div>
                                                <span>{{ format_currency($product->price) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop-product-wrapper res-xl res-xl-btn">
                        <div class="shop-bar-area">
                            <div class="shop-bar pb-60">
                                <div class="shop-found-selector">
                                    <div class="shop-found">
                                        <p><span>{{ $products->total() }}</span> Product Found of
                                            <span>{{ $count_products }}</span>
                                        </p>
                                    </div>
                                    <div class="shop-selector">
                                        <label>Sort By : </label>
                                        <select class="sort-by">
                                            <option
                                                value="{{ route('products.index', ['categories_id' => g('categories_id'), 'q' => g('q'), 'sort' => null]) }}"
                                                @if (g('sort') == null) selected @endif>Default
                                            </option>
                                            <option
                                                value="{{ route('products.index', ['categories_id' => g('categories_id'), 'q' => g('q'), 'sort' => 'asc']) }}"
                                                @if (g('sort') == 'asc') selected @endif>A to Z
                                            </option>
                                            <option
                                                value="{{ route('products.index', ['categories_id' => g('categories_id'), 'q' => g('q'), 'sort' => 'desc']) }}"
                                                @if (g('sort') == 'desc') selected @endif> Z to A
                                            </option>
                                            <option
                                                value="{{ route('products.index', ['categories_id' => g('categories_id'), 'q' => g('q'), 'sort' => 'in_stock']) }}"
                                                @if (g('sort') == 'in_stock') selected @endif>In
                                                stock
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="shop-filter-tab">
                                    <div class="shop-tab nav" role=tablist>
                                        <a class="active" href="#grid-sidebar1" data-bs-toggle="tab" role="tab"
                                            aria-selected="false">
                                            <i class="ti-layout-grid4-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-product-content tab-content">
                                <div id="grid-sidebar1" class="tab-pane fade active show">
                                    <div class="row">
                                        @foreach ($products as $product)
                                            <div class="col-lg-6 col-md-6 col-xl-3">
                                                <div class="product-wrapper mb-30">
                                                    <div class="product-img">
                                                        <a href="{{ url("products/$product->permalink") }}">
                                                            <img src="{{ asset($product->image) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-content">
                                                        <h4><a href="{{ url("products/$product->permalink") }}">{{ $product->name }}
                                                            </a></h4>
                                                        <span>{{ format_currency($product->price) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-30 text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(function() {
                $('.sort-by').on('change', function() {
                    window.location = $(this).val();
                });
            });
        </script>
    @endpush
@endsection
