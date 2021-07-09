@extends('frontend.layouts.app')
@section('title', 'Transaction')
@section('content')
    <div class="card mb-2">

        <div class="card-body p-2">
            <h6><i class="fas fa-filter"></i> Filter</h6>

            <div class="row">
                <div class="col-6">
                    <div class="input-group my-2">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Date</label>
                        </div>
                        <input type="text" class="date" id="date" value="{{request()->date ?? date('Y-m-d')}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group my-2 ">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Type</label>
                        </div>
                        <select class="custom-select type">
                            <option value="">ALL</option>
                            <option value="1" @if (request()->type == 1) selected @endif>Income</option>
                            <option value="2" @if (request()->type == 2) selected @endif>Outcome</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <h6>Transactions</h6>
    <div class="infinite-scroll">
        <div class="transaction">
            @foreach ($transactions as $transaction)
                <a href="{{ url('/transaction/' . $transaction->trx_id) }}">
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Trx Id : {{ $transaction->trx_id }}</h6>
                                <p class="mb-1 @if ($transaction->type == 1) text-success
                                @elseif($transaction->type==2)text-danger @endif
                                    ">{{ $transaction->amount }} <small>MMK</small></p>
                            </div>
                            <p class="mb-1 text-muted">
                                @if ($transaction->type == 1)
                                    From
                                @elseif($transaction->type == 2)
                                    To
                                @endif

                                {{ $transaction->source ? $transaction->source->name : '-' }}
                            </p>
                            <p class="text-muted">
                                {{ $transaction->created_at }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('ul.pagination').hide();
        $(function() {

            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div class="text-center"> alt="Loading..." /></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });

            $('.type').change(function() {
                var type = $('.type').val();
                history.pushState(null, '', `?type=${type}`);
                window.location.reload();
            });

            $('.date').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                }
            });
            $('#date').on('apply.daterangepicker', function(ev, picker) {
                var date=$('.date').val();
                var type = $('.type').val();
                 history.pushState(null, '', `?date=${date}&type=${type}`);
                window.location.reload();
            });
        });
    </script>

@endsection
