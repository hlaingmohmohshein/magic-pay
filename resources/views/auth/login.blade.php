@extends('frontend.layouts.app_plain')
@section('title', 'Login')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-8">
                <div class="card auth-form">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h3 class="text-center">Login</h3>
                            <p class="text-center text-multed">Fill the form to Login.</p>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"  name="email" class="form-control @error('email') is-invalid @enderror"    autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label for="email">Password</label>
                                <input type="password"  name="password" class="form-control @error('password') is-invalid @enderror"   autocomplete="password" autofocus>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div><button class="btn btn-theme btn-block my-3">Login</button></div>
                            
                            <div class="d-flex  justify-content-between">
                                
                                    <a href="{{route('register')}}">Sign Up</a>
                                    @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}">
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
