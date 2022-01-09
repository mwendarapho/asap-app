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



<table class="table table-hover table-sm" id="membersTable">
    <thead>
    <tr>
        <th class="d-print-none"></th>
        <th>id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Category</th>
        <th>Status</th>

        <th class="d-print-none">Del</th>

        {{--<th class="d-print-none">Category_id</th>
       <th class="d-print-none">created_at</th>
       <th class="d-print-none">updated_at</th>--}}

    </tr>
    </thead>

    <tfoot>
        <tr>
            <th class="d-print-none"></th>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Category</th>
            <th>Status</th>
    
                {{--<th class="d-print-none">Del</th>
    
        <th class="d-print-none">Category_id</th>
           <th class="d-print-none">created_at</th>
           <th class="d-print-none">updated_at</th>--}}
    
        </tr>
    </tfoot>
</table>
@stop
@section('scripts')
    <!-- DataTables -->

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/datatables.min.js" defer></script>

    <!--<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/datatables.min.js"></script>-->




    <script type="text/javascript">
        $(document).ready(function(){
            let getdata ="<?php  echo route($members['link']); ?>";

            $('#membersTable').DataTable({
                "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
               
                                            
                processing: true,
                serverSide: true,

                ajax: getdata,
                columns: [
                    {"data": "show",
                        'orderable': false,
                        'searchable': false,
                        'exportable': false,
                        'printable': false},
                    { data: 'id', name: 'members.id' },
                    { data: 'fname', name: 'members.fname' },
                    { data: 'lname', name: 'members.lname' },
                    { data: 'mobile', name: 'members.mobile' },
                    { data: 'email', name: 'members.email' },
                    { data: 'name', name: 'categories.name' },
                    { data: 'status', name: 'members.status' },

                    {"data": "del",
                        'orderable': false,
                        'searchable': false,
                        'exportable': false,
                        'printable': false},



                ],

                initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var input = document.createElement("input");
                            $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column.search(val ? val : '', true, false).draw();
                            });
                        });
                    }

                
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
