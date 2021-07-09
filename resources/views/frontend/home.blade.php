@extends('frontend.layouts.app')
@section('title', 'Magic Pay')
@section('content')
<div class="home">
    <div class="row">
        <div class="col-12">
            <div class="profile mb-3">
                <img src="https://eu.ui-avatars.com/api/?background=5842E3&color=fff&name={{$user->name}}" alt="">
                <h5>{{$user->name}}</h5>
                <p class="text-multed">{{$user->wallet ? number_format($user->wallet->amount) : '0'}} MMK</p>
            </div>
        </div>
        <div class="col-6">
            <div class="card shortcut-box">
                <a href="{{url('/scan-and-pay')}}">
                    <div class="card-body p-3">
                        <img src="{{asset('img/qr-code-scan.png')}}" alt="">
                        <span>Scan&Pay</span>
                    </div>
                </a>

            </div>
        </div>
        <div class="col-6">
            <div class="card shortcut-box">
                <a href="{{url('/receive-qr')}}">
                    <div class="card-body p-3">
                        <img src="{{asset('img/qr-code.png')}}" alt="">
                        <span>Recieve QR</span>
                    </div>
                </a>

            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="card function-box mb-3">
                <div class="card-body pr-0">
                        <a href="{{url('transfer')}}" class="d-flex justify-content-between update-password">

                            <span ><img src="{{asset('img/money-transfer.png')}}" alt="">Transfer</span>
                            <span class="mr-3"><i class="fas fa-angle-right"></i></span>
                        </a>
                    <hr>
                        <a href="{{route('wallet')}}" class="d-flex justify-content-between update-password">
                            <span ><img src="{{asset('img/wallet.png')}}" alt="">Wallet</span>
                            <span class="mr-3"><i class="fas fa-angle-right"></i></span>
                        </a>
                    <hr>
                    <a href="{{url('/transaction')}}" class="d-flex justify-content-between logout">
                        <span><img src="{{asset('img/transaction.png')}}" alt="">Transcation  </span>
                        <span class="mr-3"><i class="fas fa-angle-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
