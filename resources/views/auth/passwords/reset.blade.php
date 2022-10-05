@extends('auth.layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mb-2 text-center">
            <img src="{{ asset('img/logo/infinite_Studios_kinema.png') }}" alt="logo" srcset="" width="100%" class="imig img-fluid">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-2 text-center">
            <img src="{{ asset('img/logo/wis-depan.png') }}" alt="logo" srcset="" width="100px" class="imig img-fluid">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-2 text-center">
            <p class="fs-3 p3 font-effect-shadow-multiple">Wide Information Systems</p>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="card cards bg-white">
                <div class="card-header text-center border-danger formed text-white text-lg mb-3 fs-5"><b>Form - Login</b></div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-2 text-center">
            <img src="{{ asset('img/logo/infinite_Studios_Logo-03.png') }}" alt="logo" srcset="" width="100%" class="imig img-fluid">
        </div>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">

<script src="{{ asset('assets/fontawesome/js/all.js') }}"></script>

<style>
    .formed {
        background: linear-gradient(to top left, #0072b5 0%, #00b3b3 80%);
    }

    div {
        font-family: 'Trebuchet MS', sans-serif;
    }

    .p3 {
        font-family: 'Berkshire Swash', cursive;
        color: black;
        font-weight: 500;
        text-shadow: -2px 0px white;
    }

    .card {

        border: 1px solid #eee;
        box-shadow: rgba(0, 0, 0, 0.06) 0px 2px 4px;
        transition: all .3s ease-in-out;
    }

    .card:hover {
        box-shadow: rgba(0, 0, 0, 0.32) 0px 19px 37px;
        transform: translate3d(0px, -1px, 0px);
    }

    button:hover {
        box-shadow: rgba(0, 0, 0, 0.32) 0px 6px 14px;
    }
</style>
@endpush

@push('scripts')
<script>

</script>
@endpush