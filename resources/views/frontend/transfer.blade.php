@extends('frontend.layouts.app')
@section('title', 'Transfer')
@section('content')
    <div class="transfer">
        <div class="card ">

            <div class="card-body">


                <form action="{{ url('transfer/confirm') }}" method="GET" class="submit-form" autocomplete="off" id="transfer_form">
                    @csrf
                    <input type="hidden" value="" class="hash_value"  name="hash_value">
                    <div class="form-group">
                        <label class="mb-1">From</label>
                        <p class="mb-1">{{ $authUser->name }}</p>
                        <p class="mb-1">{{ $authUser->phone }}</p>
                    </div>
                    <div class="form-group">
                        <label>To <span class="to_account_info text-success"></span> </label>
                        <div class="input-group">
                            <input type="text" name="to_phone" value="{{ old('to_phone') }}"
                                class="form-control to_phone @error('to_phone') is-invalid @enderror"
                                autocomplete="to_phone" autofocus>
                            @error('to_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="input-group-append">
                                <span class="input-group-text btn btn-theme verify_btn"><i class="fas fa-check-circle"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1">Amount (MMK)</label>
                        <input type="text" name="amount" value="{{ old('amount') }}"
                            class="form-control @error('amount') is-invalid @enderror amount" autocomplete="amount" autofocus>
                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-1">Description</label>
                        <textarea name="description" class="form-control description">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-theme btn-block submit-btn">Continue</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.verify_btn').on('click', function() {
                var phone = $('.to_phone').val();
                $.ajax({
                    'url': '/to-account-verify?phone=' + phone,
                    'type': 'GET',
                    'success': function(res) {
                        if (res.status == 'success') {
                            $('.to_account_info').text('(' + res.data['name'] + ')');
                        } else {
                            $('.to_account_info').text('(' + res.message + ')');
                        }
                    }
                });
            });
        });

        $('.submit-btn').on('click', function(e) {

            e.preventDefault();
            var to_phone = $('.to_phone').val();
            var amount = $('.amount').val();
            var description = $('.description').val();
            // alert(to_phone+amount+description);
            $.ajax({
                "url":`/transfer-hash?to_phone=${to_phone}&amount=${amount}&description=${description}`,
                "type":'GET',
                "success":function(res){
                    // console.log(res.data);
                    if(res.status == 'success'){
                        $('.hash_value').val(res.data);
                        $('#transfer_form').submit();
                    }
                }
            });
        });
    </script>
@endsection
