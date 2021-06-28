@extends('backend.layouts.app')
@section('admin-user-active', 'mm-active')
@section('title', 'Admin User')
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
                <div> Admin User
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <a href="{{ route('admin.admin-user.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"> Create
                Admin User</i></a>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-border Datatable">
                    <thead>
                        <tr class="bg-light">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>IP</th>
                            <th>User Agent</th>
                            <th>Created At</th>
                            <th>Updated Up</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF_TOKEN': token.content
                }
            });
        }
        var table = $('.Datatable').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": "/admin/admin-user/datatable/ssd",
            "columns": [{
                    data: "name",
                    name: "name",

                },
                {
                    data: "email",
                    name: "email"
                },
                {
                    data: "phone",
                    name: "phone"
                },
                {
                    data: "ip",
                    name: "ip"
                },
                {
                    data: "user_agent",
                    name: "user_agent",
                    sortable: false
                },
                {
                    data: "created_at",
                    name: "created_at",
                    sortable: false
                },
                {
                    data: "updated_at",
                    name: "updated_at",
                    sortable: false
                },
                {
                    data: "action",
                    name: "action",
                    sortable: false,
                    // searchable:false
                }

            ],
            "order": [
                [6, "desc"]
            ],
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            alert(id);
            Swal.fire({
                title: 'Are you sure want to Delete?',
                showCancelButton: true,
                confirmButtonText: `Confirm`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/admin-user/' + id,
                        type: 'DELETE',
                        success: function() {
                            table.ajax.reload();
                        }
                    });
                }
            })
        });

    });
</script>
@endsection
