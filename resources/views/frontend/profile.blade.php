@extends('frontend.layouts.app')
@section('title','Profile')
@section('content')
<div class="account">
    <div class="profile mb-3">
        <img src="https://eu.ui-avatars.com/api/?background=5842E3&color=fff&name=HlaingMohMohShein" alt="">
    </div>
    <div class="card mb-3">
        <div class="card-body pr-0">
            <div class="d-flex justify-content-between">
                <span>Username</span>
                <span class="mr-3">{{$user->name}}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span>Email</span>
                <span class="mr-3">{{$user->email}}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span>Phone</span>
                <span class="mr-3">{{$user->phone}}</span>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body pr-0">
                <a href="{{route('update-password')}}" class="d-flex justify-content-between update-password">
                    <span >Update Password</span>
                    <span class="mr-3"><i class="fas fa-angle-right"></i></span>
                </a>
            <hr>
            <a href="#" class="d-flex justify-content-between logout">
                <span>Logout</span>
                <span class="mr-3"><i class="fas fa-angle-right"></i></span>
            </a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>

    $(document).on('click', '.logout', function(e) {

            e.preventDefault();
            Swal.fire({
                title: 'Are you sure want to Logout?',
                showCancelButton: true,
                confirmButtonText: `Confirm`,
                reverseButtons:true

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url:"{{route('logout')}}",
                        type: 'POST',
                        success: function(){
                            window.location.replace("{{route('profile')}}");
                        }
                    });

                }
            })
        });
</script>
@endsection
