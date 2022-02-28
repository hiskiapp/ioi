@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')
    <div class="register-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-6 col-xl-6 ms-auto me-auto">
                    <div class="login">
                        <div class="login-form-container">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="login-form">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    @error('email')
                                        <div class="text-danger">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Email Address">
                                    <div class="button-box">
                                        <button type="submit" class="default-btn floatright">Send Password Reset
                                            Link</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
