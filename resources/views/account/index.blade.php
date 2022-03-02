@extends('layouts.app')
@section('title', 'My Account')
@section('content')
    @include('layouts.partials.breadcumb', ['bg' => get_setting('breadcumb_my_account')])
    <div class="register-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-12 col-xl-6 ms-auto me-auto">
                    <div class="login">
                        <div class="login-form-container">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="login-form">
                                <form method="POST" action="{{ route('account.update') }}">
                                    @csrf
                                    @error('name')
                                        <div class="text-danger">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', auth()->user()->name) }}" required
                                        autocomplete="name" autofocus placeholder="Name">

                                    @error('email')
                                        <div class="text-danger">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', auth()->user()->email) }}" required
                                        autocomplete="email" placeholder="Email">

                                    @error('password')
                                        <div class="text-danger">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password" placeholder="Password">

                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password"
                                        placeholder="Confirm Password">
                                    <span class="text-muted text-sm">
                                        * Kosongkan <i>form password</i> jika tidak ingin mengubah password
                                    </span>
                                    <div class="button-box">
                                        <button type="submit" class="default-btn floatright">Save</button>
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
