@extends('layouts.app')
@section('title','Members')

@section('content')
    <div class="container py-3">
    <h1>Members</h1>
        <a href="{{ route('member.create') }}" class="btn btn-sm btn-success">Create Member</a>
    </div>

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

@endsection


    <table class="table table-hover" id="memebersTable">
        <thead>
        <tr>
            <th>#</th>
            <th>First</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>status</th>
            <th>Category</th>
            <th class="d-print-none">Menu</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
        <tr>
            <td><a href="member/{{ $member->id }}"><span data-feather="arrow-right-circle" class="small text-success"></span></a>{{ $member->id}}</td>
            <td>{{ $member->fname.' '.$member->lname }}</td>
            <td>{{ $member->mobile }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ ($member->status? 'active' : 'inactive') }}</td>
            <td>{{ $member->category->name }}</td>

            <td>
                <a  class="btn btn-outline-primary btn-sm" href="{{ 'member/'.$member->id.'/edit' }}">Edit</a>
                <a class="btn btn-outline-danger btn-sm"  id="delete-member" href="{{ 'member/'.$member->id }}">Delete</a>
            </td>

        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>#</th>
            <th>First</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>status</th>
            <th>Category</th>
            <th class="d-print-none">Menu</th>
        </tr>
        </tfoot>
    </table>
    <div class="container-fluid align-content-lg-center">
        {{ $members->links() }}
    </div>

@endsection
@section('scripts')

    <script type="text/javascript">

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

                        //$('#invoices').DataTable().ajax.reload();
                        location.reload();


                        console.log("Successful Del");

                    }

                })
            }
        });

    </script>

@endsection
