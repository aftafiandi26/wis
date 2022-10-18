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
            <div class="card bg-white">
                <div class="card-header text-center border-danger formed text-white text-lg mb-3 fs-5"><b>Form - Login</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="input-group flex-nowrap">
                                <label for="username" class="input-group-text" title="username"><i class="fa-solid fa-user"></i></label>

                                <div class="col">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="username">
                                </div>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="input-group flex-nowrap">
                                <label for="password" class="input-group-text" title="password"><i class="fa-solid fa-lock"></i></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-md btn-outline-primary">
                                    <i class="fa-solid fa-right-to-bracket"></i> Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-12">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
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

    input:hover {
        box-shadow: rgba(0, 0, 0, 0.32) 0px 6px 14px;
    }
</style>
@endpush

@push('scripts')
<script>

</script>
@endpush