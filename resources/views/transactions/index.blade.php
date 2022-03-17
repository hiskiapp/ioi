@extends('layouts.app')
@section('title', 'Transactions')
@section('content')
    @include('layouts.partials.breadcumb', ['bg' => get_setting('breadcumb_order')])

    <div class="food-menu-area bg-img pt-115 pb-90" style="background-image: url(assets/img/bg/13.jpg)">
        <div class="container">
            <div class="food-menu-product-style">
                <div class="food-menu-list text-center mb-65 nav" role="tablist">
                    <a
                        @if (request()->segment(2) == null) class="active" href="#all" data-bs-toggle="tab" role="tab" @else href="{{ route('transactions.index') }}" @endif>
                        <h4>All </h4>
                    </a>
                    <a
                        @if (request()->segment(2) == 'unpaid') class="active" href="#all" data-bs-toggle="tab" role="tab" @else href="{{ route('transactions.unpaid') }}" @endif>
                        <h4>Unpaid </h4>
                    </a>
                    <a
                        @if (request()->segment(2) == 'process') class="active" href="#all" data-bs-toggle="tab" role="tab" @else href="{{ route('transactions.process') }}" @endif>
                        <h4>Process </h4>
                    </a>
                    <a
                        @if (request()->segment(2) == 'shipping') class="active" href="#all" data-bs-toggle="tab" role="tab" @else href="{{ route('transactions.shipping') }}" @endif>
                        <h4> Shipping</h4>
                    </a>
                    <a
                        @if (request()->segment(2) == 'success') class="active" href="#all" data-bs-toggle="tab" role="tab" @else href="{{ route('transactions.success') }}" @endif>
                        <h4> Success </h4>
                    </a>
                    <a
                        @if (request()->segment(2) == 'expired') class="active" href="#all" data-bs-toggle="tab" role="tab" @else href="{{ route('transactions.expired') }}" @endif>
                        <h4> Expired </h4>
                    </a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (count($transactions->items()) == 0)
                    <center><span class="h1 text-center">-- no transaction yet --</span></center>
                @endif
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="all" role="tabpanel">
                        <div class="row menu-product-wrapper">
                            @foreach ($transactions as $transaction)
                                <div class="col-lg-6">
                                    <div class="single-menu-product mb-30">
                                        <div class="menu-product-img">
                                            <img src="{{ url($transaction->thumb) }}"
                                                alt="Transaction: {{ $transaction->code }}"
                                                style="max-width: 160px !important;">
                                        </div>
                                        <div class="menu-product-content">
                                            <h4><a
                                                    href="{{ route('transactions.show', $transaction->code) }}">{{ $transaction->code }}</a>
                                            </h4>
                                            <div class="menu-product-price-rating">
                                                <div class="menu-product-price">
                                                    <span
                                                        class="menu-product-new">{{ format_currency($transaction->total_price) }}</span>
                                                </div>
                                                <div class="menu-product-rating">
                                                    <span>{{ date('d-M-Y H:i', strtotime($transaction->created_at)) }}</span>
                                                    <br>
                                                    <span
                                                        class="text-{{ class_status($transaction->status) }} mt-3">{{ $transaction->status }}</span>
                                                </div>
                                            </div>
                                            <p>Products: {{ $transaction->items }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
    <!-- menu area end -->
@endsection
