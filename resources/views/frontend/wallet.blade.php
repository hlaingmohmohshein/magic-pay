@extends('frontend.layouts.app')
@section('title', 'Wallet')
@section('content')
    <div class="wallet">
        <div class="card my-card">
            <div class="card-body">
                <input type="text" id="date">
                <div class="mb-3">
                    <span>Budget</span>
                    <h4>{{number_format($authUser->wallet ? $authUser->wallet->amount : '0')}} <span>MMK</span> </h3>
                </div>
                <div class="mb-4">
                    <span>Account Number</span>
                    <h5>{{$authUser->wallet ? $authUser->wallet->account_number : '-'}}</h3>
                </div>
                <div class="">
                    <p>
                        {{$authUser->name}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>

    $(function(){
        $('#date').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "locale": {
                    "format": "MM/DD/YYYY",
                    "separator": " - ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Su",
                        "Mo",
                        "Tu",
                        "We",
                        "Th",
                        "Fr",
                        "Sa"
                    ],
                    "monthNames": [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ],
                    "firstDay": 1
                },
                "startDate": "07/02/2021",
                "endDate": "07/08/2021"
            }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format(
                    'YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
    });
</script>
@endsectionn
