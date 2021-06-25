@extends('backend.layouts.app')
@section('admin-user-active', 'mm-active')
@section('title', 'Edit Admin User')
@section('content')
@section('extra-css')

@endsection

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Edit Admin User
                </div>
            </div>
        </div>
    </div>
    @include('backend.layouts.flash')
    <div class="content pt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.admin-user.update',$admin_user->id)}}" method="POST" id="update">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$admin_user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{$admin_user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone" value="{{$admin_user->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary mr-2 back-btn">Cancel</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
{{-- {!! JsValidator::formRequest('App\Http\Requests\StoreAdminUser','#update') !!} --}}

<script>
    $(document).ready(function() {
        $('.Datatable').DataTable({

        });
    });
</script>
@endsection
