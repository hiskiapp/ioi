@extends('layouts.app')
@section('title', 'Transaction: ' . $transaction->code)
@section('content')
    @include('layouts.partials.breadcumb', [
        'bg' => get_setting('breadcumb_order'),
        'parent' => 'Transactions',
    ])
    <!-- shopping-cart-area start -->
    <div class="contact-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="cart-heading">Transaction Items</h4>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (in_array($transaction->status, ['Unpaid', 'Checking']))
                        <div class="alert alert-danger">
                            <a href="{{ route('payment.index', $transaction->code) }}"> This transaction has not been paid
                                yet! Please confirm payment here. Pay before
                                <b>{{ date('d M Y H:i', strtotime('+1 days', strtotime($transaction->created_at))) }}</b></a>
                        </div>
                        @if ($transaction->status == 'Checking')
                            <div class="alert alert-info">
                                your payment is being checked by admin
                            </div>
                        @endif

                        @if (optional($transaction->payment)->status == 'Rejected')
                            <div class="alert alert-danger">
                                your payment has been rejected, please transfer correctly
                            </div>
                        @endif
                    @endif
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
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
                                @foreach ($transaction->items as $item)
                                    <tr>
                                        <td class="product-name"><a
                                                href="{{ url("products/$item->products_permalink") }}"
                                                target="_blank">{{ $item->products_name }}
                                            </a></td>
                                        <td class="product-price-cart"><span
                                                class="amount">{{ format_currency($item->products_price) }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            {{ $item->quantity }}
                                        </td>
                                        @php
                                            $subtotal = $item->products_price * $item->quantity;
                                            $total += $subtotal;
                                        @endphp
                                        <td class="product-subtotal" id="item{{ $item->id }}-subtotal">
                                            {{ format_currency($subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ms-auto">
                            <div class="cart-page-total">
                                <ul>
                                    <li>Total<span id="cart-totals">{{ format_currency($total) }}</span></li>
                                    <li>Payment<span id="cart-totals">{{ $transaction->payment_methods_name }}</span>
                                    </li>
                                    <li>Status<span id="cart-totals"
                                            class="text-{{ class_status($transaction->status) }}">{{ $transaction->status }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @if (in_array($transaction->status, ['Shipping', 'Success']))
                        <div class="contact-info-wrapper pb-20">
                            <div class="contact-title">
                                <h4>Shipping Detail</h4>
                            </div>
                            <div class="contact-info">
                                <div class="single-contact-info">
                                    <div class="contact-info-icon">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="contact-info-text">
                                        <p><span>Courier:</span> {{ optional($transaction->shipping)->courier ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="single-contact-info">
                                    <div class="contact-info-icon">
                                        <i class="pe-7s-mail"></i>
                                    </div>
                                    <div class="contact-info-text">
                                        <p><span>Resi: </span> {{ optional($transaction->shipping)->resi ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="single-contact-info">
                                    <div class="contact-info-icon">
                                        <i class="ti-location-pin"></i>
                                    </div>
                                    <div class="contact-info-text">
                                        <p><span>Address: </span> {{ optional($transaction->shipping)->address ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="contact-info-wrapper">
                        <div class="contact-title">
                            <h4>Shipping Location</h4>
                        </div>
                        <div class="contact-info">
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="ti-location-pin"></i>
                                </div>
                                <div class="contact-info-text">
                                    <p><span>Main Address:</span> {{ $transaction->main_address }}</p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="pe-7s-mail"></i>
                                </div>
                                <div class="contact-info-text">
                                    <p><span>Receive Name: </span> {{ $transaction->receive_name }}</p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="pe-7s-call"></i>
                                </div>
                                <div class="contact-info-text">
                                    <p><span>Phone: </span> {{ $transaction->phone }}</p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="ti-location-pin"></i>
                                </div>
                                <div class="contact-info-text">
                                    <p><span>Province:</span> {{ $transaction->province }}</p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="ti-location-pin"></i>
                                </div>
                                <div class="contact-info-text">
                                    <p><span>City:</span> {{ $transaction->city }}</p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-info-icon">
                                    <i class="ti-location-pin"></i>
                                </div>
                                <div class="contact-info-text">
                                    <p><span>District:</span> {{ $transaction->district }}</p>
                                </div>
                            </div>
                            @if ($transaction->detail)
                                <div class="single-contact-info">
                                    <div class="contact-info-icon">
                                        <i class="ti-list"></i>
                                    </div>
                                    <div class="contact-info-text">
                                        <p><span>Detail:</span> {{ $transaction->detail }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($transaction->note)
                                <div class="single-contact-info">
                                    <div class="contact-info-icon">
                                        <i class="ti-pencil"></i>
                                    </div>
                                    <div class="contact-info-text">
                                        <p><span>Note:</span> {{ $transaction->note }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shopping-cart-area end -->
@endsection
