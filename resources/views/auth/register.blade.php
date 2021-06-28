@extends('frontend.layouts.app_plain')
@section('title','Register')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-8">
                <div class="card auth-form">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h3 class="text-center">Register</h3>
                            <p class="text-center text-muted">Fill the form to Register.</p>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    autocomplete="name" autofocus value="{{old('name')}}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    autocomplete="email" autofocus value="{{old('email')}}"> 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" autocomplete="phone"
                                    autofocus value="{{old('phone')}}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="email">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" autocomplete="password" value="{{old('password')}}"
                                    autofocus>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="password_confirmation" value="{{old('password_confirmation')}}"
                                    autofocus>
                                @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div><button class=" btn btn-theme btn-block my-3">Register</button></div>

                            <div class="d-flex  justify-content-between">

                                <a href="{{ route('login') }}">Already Have An Account?</a>
                                @if (Route::has('password.request'))
                                    <a class="" href="{{ route('login') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
