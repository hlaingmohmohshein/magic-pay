@extends('frontend.layouts.app')
@section('title','Update Password')
@section('content')
<div class="update-password">
    <div class="card mb-3">
        <div class="card-body">

            <form action="{{route('update-password.store')}}" method="POST" >
            @csrf
           @include('frontend.layouts.flash')
                <div class="text-center">
                <img src="{{asset('img/update_password.png')}}" alt="">
            </div>
            <div class="form-group">
                <lable for="old_password" >Old Password</lable>
                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" value="{{old('old_password')}}">
                @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <lable for="new_password">New Password</lable>
                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" value="{{old('new_password')}}">
                @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class=" btn btn-theme   btn-block"> Update Password</button>
        </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection
