@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
    @include('layouts.partials.breadcumb', ['bg' => get_setting('breadcumb_checkout')])
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <form method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="checkbox-form">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="country-select">
                                        <label>Addresses <span class="required">*</span></label>
                                        <select>
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->id }}">
                                                    {{ str_limit($address->main_address, 20) }}</option>
                                            @endforeach
                                            <option value="">** New Address</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Receive Name <span class="required">*</span></label>
                                        <input type="text" name="receive_name" placeholder=""
                                            value="{{ auth()->user()->name }}" required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Main Address <span class="required">*</span></label>
                                        <input type="text" name="main_address" placeholder="Street address" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Province <span class="required">*</span></label>
                                        <input type="text" name="province" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" name="city" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>District <span class="required">*</span></label>
                                        <input type="text" name="district" placeholder="" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" name="phone" required />
                                    </div>
                                </div>
                                <div class="col-md-6 order-notes">
                                    <div class="checkout-form-list mrg-nn">
                                        <label>Detail</label>
                                        <textarea name="detail" id="detail" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 order-notes">
                                    <div class="checkout-form-list mrg-nn">
                                        <label>Note</label>
                                        <textarea name="note" id="note" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($items as $item)
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{ $item->products_name }} <strong class="product-quantity"> ×
                                                        {{ $item->total_order }}</strong>
                                                </td>
                                                <td class="product-total">
                                                    @php
                                                        $subtotal = $item->total_order * $item->products_price;
                                                        $total += $subtotal;
                                                    @endphp
                                                    <span class="amount">{{ format_currency($subtotal) }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">{{ format_currency($total) }}</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span
                                                        class="amount">{{ format_currency($total) }}</span></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <h3 style="border-bottom: 1px solid #d8d8d8; padding-bottom: 10px;">Select Payment</h3>
                                    <div class="panel-group" id="faq">
                                        @foreach ($payments as $payment)
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> <a data-bs-toggle="collapse"
                                                            aria-expanded="true" href="#payment-{{ $loop->iteration }}">
                                                            {{ $payment->name }}.</a></h5>
                                                </div>
                                                <div id="payment-{{ $loop->iteration }}"
                                                    class="panel-collapse collapse show" data-bs-parent="#faq">
                                                    <div class="panel-body">
                                                        <p>
                                                            Account Number: {{ $payment->account_number }} <br>
                                                            Account Owner: {{ $payment->account_owner }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="order-button-payment">
                                        <input type="submit" value="Place order" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection
