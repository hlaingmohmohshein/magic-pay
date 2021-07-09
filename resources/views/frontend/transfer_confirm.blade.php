@extends('frontend.layouts.app')
@section('title', 'Transfer Confirm')
@section('content')
    <div class="transfer">
        {{-- @if (Session->('fail'))
{{session('fail')}}
        @endif --}}


        <div class="card ">

            <div class="card-body">
                @include('frontend.layouts.flash')
                <form action="{{ url('transfer/complete') }}" method="POST" id="form">
                    @csrf
                    <input type="hidden" name="hash_value" value="{{ $hash_value }}" >
                    <input type="hidden" name="description" value="{{ $description }}">
                    <input type="hidden" name="amount" value="{{ $amount }}">
                    <input type="hidden" name="to_phone" value="{{ $to_account->phone }}">
                    <div class="form-group">
                        <label for="" class="mb-0"><strong>From</strong></label>
                        <p class="mb-1">{{ $from_account->name }}</p>
                        <p class="mb-1">{{ $from_account->phone }}</p>
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-0"><strong>To</strong></label>
                        <p class="mb-1 text-muted">{{ $to_account->name }}</p>
                        <p class="mb-1 text-muted">{{ $to_account->phone }}</p>
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-0"><strong>Amount</strong></label>
                        <p class="mb-1 text-muted">{{ number_format($amount) }}</p>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="" class="mb-0"><strong>Description</strong></label>
                            <p class="mb-1 text-muted">{{ $description }}</p>
                        </div>
                        <button type="submit" class="btn btn-theme btn-block confirm_btn">Confirm</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.confirm_btn').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '<strong>Please Fill Your Password</strong>',
                    icon: 'info',
                    html: '<input type="password" class="form-control text-center password " autofocus></input>',
                    reverseButtons: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Confirm!',
                    confirmButtonAriaLabel: 'Confirm',
                    cancelButtonText: '<i class="fa fa-thumbs-down"></i> Cancel',
                    cancelButtonAriaLabel: 'Cancel'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        var password = $('.password').val();
                        $.ajax({
                            'url': '/to-account-verify/password-check?password=' + password,
                            'type': 'GET',
                            'success': function(res) {
                                // console.log(res.status)

                                if (res.status == 'success') {
                                    $('#form').submit();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: res.message
                                    })
                                }
                            },
                            'error':function(err){
                                alert(err.message);
                            }
                        });
                    }
                })
            })
        });
    </script>
@endsection
