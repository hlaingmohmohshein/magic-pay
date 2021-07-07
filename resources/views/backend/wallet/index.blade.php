@extends('backend.layouts.app')
@section('wallet-active', 'mm-active')
@section('title', 'User')
@section('content')
@section('extra-css')

@endsection

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-wallet icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>  Wallet
                </div>
            </div>
        </div>
    </div>

    
    <div class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-border Datatable">
                    <thead>
                        <tr class="bg-light">
                            <th>Account Number</th>
                            <th>Account Person</th>
                            <th>Amount</th>
                            <th>Created At</th>
                            <th>Updated At</th>
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
        let token=document.head.querySelector('meta[name="csrf-token"]');
        if(token){
            $.ajaxSetup({
                headers: {
                    'X-CSRF_TOKEN' : token.content
                }
            });
        }
       var table= $('.Datatable').DataTable({
            
            "processing": true,
            "serverSide": true,
            "ajax": "/admin/wallet/database/ssd",
           
            "columns": [{
                    data: "account_number",
                    name: "account_number",

                },
                {
                    data: "account_person",
                    name: "account_person"
                },
                {
                    data: "amount",
                    name: "amount"
                },
                {
                    data: "created_at",
                    name: "created_at",
                    sortable:false
                },
                {
                    data: "updated_at",
                    name: "updated_at",
                    
                }

            ],
            "order": [[4, "desc" ]]
            
        });
        $(document).on('click','.delete',function(e){
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
                    url:'/admin/user/'+id,
                    type:'DELETE',
                    success:function(){
                            table.ajax.reload();
                    }
                });
            }
            })
        });

    });
</script>
@endsection
