@extends('layouts.app')
@section('content')
    <div class="container py-3">
        <a href="{{ route('member.create') }}" class="btn btn-sm btn-success">Create Member</a>

    </div>

    <table class="table table-hover">
        <thead>
        <tr>

            <th scope="col">First</th>
            <th scope="col">Mobile</th>
            <th scope="col">Email</th>
            {{--<th scope="col">Address</th>--}}
            <th scope="col">DOB</th>
            <th scope="col">Spouse Name</th>
            <th scope="col">Spouse Mobile</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
        <tr>
            <td>{{ $member->fname.' '.$member->lname }}</td>
            <td>{{ $member->mobile }}</td>
            <td>{{ $member->email }}</td>
           {{-- <td>{{ $member->address }}</td>--}}
            <td>{{ $member->dob }}</td>
            <td>{{ $member->spouse_name }}</td>
            <td>{{ $member->spouse_mobile }}</td>
            <td>{{ ($member->status ? 'active' : 'inactive') }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container-fluid align-content-lg-center">
        {{ $members->links() }}
    </div>

@endsection
