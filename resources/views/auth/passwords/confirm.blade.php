@extends('layouts.auth')
@section('title', 'Confirm Password')
@section('content')
    <div class="register-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-12 col-xl-6 ms-auto me-auto">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="alert alert-warning">
                                Please confirm your password before continuing.
                            </div>
                            <div class="login-form">
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    @error('password')
                                        <div class="text-danger">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="current-password" placeholder="Password">

                                    <div class="button-box">
                                        <div class="login-toggle-btn">
                                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                                        </div>
                                        <button type="submit" class="default-btn floatright">Confirm Password</button>
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
