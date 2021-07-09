@extends('frontend.layouts.app')
@section('title', 'Recieve QR')
@section('content')
    <div class="recieve_qr">
        <div class="card my-card">
            <div class="card-body">
                <p class="text-center  mb-0">
                    QP Scan To Pay Me
                </p>
                <div class="text-center">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(240)->generate($authUser->phone)) !!} " >
                </div>
                <p class="text-center  mb-0">{{$authUser->name}}</p>
                <p class="text-center  mb-0">{{$authUser->phone}}</p>


            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>


</script>
