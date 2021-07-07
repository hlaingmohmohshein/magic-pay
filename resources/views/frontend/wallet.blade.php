@extends('frontend.layouts.app')
@section('title', 'Wallet')
@section('content')
    <div class="wallet">
        <div class="card my-card">
            <div class="card-body">
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
