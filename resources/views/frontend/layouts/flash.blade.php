{{-- @if ($errors->any())
@foreach ($errors->all() as $error)
{{Session::get('fail')}}
<div class="alert alert-warning alert-dismissible fade show" role="alert">

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endforeach
@endif --}}
@if ($message = Session::get('fail'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('invalid_data'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('transfer_success'))
<div class="alert alert-danger alert-block">
    {{-- <button type="button" class="close" data-dismiss="alert">×</button> --}}
    <strong>{{ $message }}</strong>
</div>
@endif

