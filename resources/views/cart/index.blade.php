@extends('layouts.app')
@section('title', 'Cart')
@section('content')
    @include('layouts.partials.breadcumb', ['bg' => get_setting('breadcumb_cart')])
    <!-- shopping-cart-area start -->
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="cart-heading">Cart</h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>remove</th>
                                    <th>images</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Total Order</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="product-remove">
                                            <a href="javascript:void(0);"
                                                onclick="event.preventDefault();document.getElementById('item{{ $item->id }}-destroy').submit();"><i
                                                    class="pe-7s-close"></i></a>
                                            <form id="item{{ $item->id }}-destroy"
                                                action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                                @method('DELETE')

                                            </form>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="{{ url("products/$item->products_permalink") }}"><img
                                                    src="{{ asset($item->products_image) }}" width="85px" alt=""></a>
                                        </td>
                                        <td class="product-name"><a
                                                href="{{ url("products/$item->products_permalink") }}">{{ $item->products_name }}
                                            </a></td>
                                        <td class="product-price-cart"><span
                                                class="amount">${{ number_format($item->products_price) }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <input value="{{ $item->total_order }}" type="number" min="1"
                                                class="items-total" data-id="{{ $item->id }}">
                                        </td>
                                        @php
                                            $subtotal = $item->products_price * $item->total_order;
                                            $total += $subtotal;
                                        @endphp
                                        <td class="product-subtotal" id="item{{ $item->id }}-subtotal">
                                            ${{ number_format($subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ms-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>Total<span id="cart-totals">{{ number_format($total) }}</span></li>
                                </ul>
                                <a href="{{ url('checkout') }}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shopping-cart-area end -->
    @push('js')
        <script>
            $(".items-total").on('keyup input', function() {
                var id = $(this).attr("data-id");
                var total_order = $(this).val();

                $.ajax({
                    url: "/cart/qty",
                    type: 'POST',
                    data: {
                        id: id,
                        total_order: total_order,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(data) {
                        $(`#item${id}-subtotal`).html(data.subtotal);
                        $('#cart-totals').html(data.total);
                    }
                });
            });
        </script>
    @endpush
@endsection
