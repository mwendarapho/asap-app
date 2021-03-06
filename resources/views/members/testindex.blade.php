@extends('layouts.app')
@section('title','Members')


@section('content')
    <div class="container py-1">
        <h1>{{$members['title']}}</h1>
        <a href="{{ route('member.create') }}" class="btn btn-sm btn-success float-right">Create Member</a>
    </div>

@section('styles')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/datatables.min.css"/>
@endsection



<table class="table table-hover table-responsive-sm" id="membersTable">
    <thead>
    <tr>
        <th>id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Category</th>
        <th>Status</th>
        <th class="d-print-none">del</th>
        <th class="d-print-none">show</th>

        {{--<th class="d-print-none">Category_id</th>
       <th class="d-print-none">created_at</th>
       <th class="d-print-none">updated_at</th>--}}

    </tr>
    </thead>
</table>
@stop
@section('scripts')
    <!-- DataTables -->

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/datatables.min.js" defer></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/datatables.min.js"></script>




    <script type="text/javascript">
        $(document).ready(function(){
            let getdata ="<?php  echo route($members['link']); ?>";

            $('#membersTable').DataTable({
                processing: true,
                serverSide: true,


                //ajax: '{!! route('allmembers') !!}',
                ajax: getdata,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'fname', name: 'fname' },
                    { data: 'lname', name: 'lname' },
                    { data: 'mobile', name: 'mobile' },
                    { data: 'email', name: 'email' },
                    { data: 'category', name: 'category' },
                    { data: 'status', name: 'status' },
                    {"data": "show",
                        'orderable': false,
                        'searchable': false,
                        'exportable': false,
                        'printable': false},
                    {"data": "del",
                        'orderable': false,
                        'searchable': false,
                        'exportable': false,
                        'printable': false},


                ]
            });

        });

        $(document).on('click', '#delete-member', function(e) {
            e.preventDefault();

            if (confirm('Delete Member, Are you sure?')) {

                var href = $(this).attr('href');
                $.ajax({
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    url: href,
                    //dataType: "json",
                    success: function() {

                        $('#membersTable').DataTable().ajax.reload();
                        //location.reload();


                        console.log("Successful Del");

                    }

                })
            }
        });

    </script>

@endsection
