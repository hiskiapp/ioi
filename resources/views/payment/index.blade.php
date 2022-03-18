@extends('layouts.app')
@section('title', 'Payment Transaction: ' . $transaction->code)
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
                    <div class="contact-map-wrapper">
                        <div class="contact-message">
                            <div class="contact-title">
                                <h4>Payment Information: <a
                                        href="{{ route('transactions.show', $transaction->code) }}">{{ $transaction->code }}</a>
                                </h4>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('payment.store', $transaction->code) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="payment_methods_id"
                                    value="{{ $transaction->payment_methods_id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-input-style mb-30">
                                            @if (optional($transaction->payment)->proof)
                                                <a href="{{ asset(optional($transaction->payment)->proof) }}"
                                                    target="_blank"><img width="100px"
                                                        src="{{ asset(optional($transaction->payment)->proof) }}"
                                                        alt="{{ $transaction->code }}" srcset=""
                                                        class="mb-20"></a>
                                                <br>
                                            @endif
                                            <label>Proof of Payment*</label>
                                            <input name="proof" required="" type="file">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-input-style mb-30">
                                            <label>Sender Name</label>
                                            <input name="sender_name" required="" type="text"
                                                value="{{ old('sender_name', optional($transaction->payment)->sender_name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-input-style mb-30">
                                            <label>Sender Number</label>
                                            <input name="sender_number" required="" type="text"
                                                value="{{ old('sender_number', optional($transaction->payment)->sender_number) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="submit contact-btn btn-hover" type="submit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <h4 style="border-bottom: 1px solid #d8d8d8; padding-bottom: 10px;">Change Payment Method</h4>
                            <div class="panel-group" id="faq">
                                @foreach ($payments as $payment)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title payment-selector" data-id="{{ $payment->id }}">
                                                <a data-bs-toggle="collapse" href="#payment-{{ $loop->iteration }}">
                                                    {{ $payment->name }}.</a>
                                            </h5>
                                        </div>
                                        <div id="payment-{{ $loop->iteration }}"
                                            class="panel-collapse collapse @if ($payment->id == $transaction->payment_methods_id) show @endif"
                                            data-bs-parent="#faq">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shopping-cart-area end -->
    @push('js')
        <script>
            $(function() {
                $('.payment-selector').on('click', function() {
                    $('input[name="payment_methods_id"]').val($(this).data('id'));
                });
            });
        </script>
    @endpush
@endsection
