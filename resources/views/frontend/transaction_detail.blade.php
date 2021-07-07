@extends('frontend.layouts.app')
@section('title', 'Transaction Detail')
@section('content')
    <div class="transaction-detail">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="{{asset('img/checked.png')}}" alt="">
                    </div>
                    @if(session('transfer_success'))
                    <div class="alert alert-success text-center fade show" role="alert">
                        {{session('transfer_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                        <h6 class=" text-center  @if ($transaction->type==1)
                            text-scssess @elseif($transaction->type==2)text-danger
                            @endif">{{ number_format($transaction->amount)}} MMK
                        </h6>
                </div>
                <div class="d-flex justify-content-between p-2">
                    <p class="mb-0 text-muted">Trx ID</p>
                    <p class="mb-0">{{$transaction->trx_id}}</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between p-2">
                    <p class="mb-0 text-muted">Ref no </p>
                    <p class="mb-0">{{$transaction->ref_no}}</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between p-2">
                    <p class="mb-0 text-muted">Type </p>
                    <p class="mb-0">
                        @if ($transaction->type==1)
                        <span class="badge badge-pill badge-success">Income</span>
                        @elseif($transaction->type==2)
                        <span class="badge badge-pill badge-danger">Expense</span>
                        @endif
                    </p>
                </div>
                <hr>
                <div class="d-flex justify-content-between p-2">
                    <p class="mb-0 text-muted">Amount</p>
                    <p class="mb-0">{{$transaction->amount}}</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between p-2">
                    <p class="mb-0 text-muted">Date & Time</p>
                    <p class="mb-0">{{$transaction->created_at}}</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between p-2">
                    <p class="mb-0">
                        @if ($transaction->type==1)
                        <span class="mb-0 text-muted">To</span>
                        @elseif($transaction->type==2)
                        <span class="mb-0 text-muted">From</span>
                        @endif
                    </p>
                    <p class="mb-0">{{$transaction->source->name}}</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between p-2">
                    <p class="mb-0 text-muted">Description</p>
                    <p class="mb-0">{{$transaction->description}}</p>
                </div>
            </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
    });
</script>
@endsection

