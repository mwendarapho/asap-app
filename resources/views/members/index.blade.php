@extends('layouts.app')
@section('title','Members')
@section('content')
    <div class="container py-3">
    <h1>Members</h1>
        <a href="{{ route('member.create') }}" class="btn btn-sm btn-success">Create Member</a>

    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Mobile</th>
            <th scope="col">Email</th>
            {{--<th scope="col">Address</th>
            <th scope="col">DOB</th>
            <th scope="col">Spouse Name</th>
            <th scope="col">Spouse Mobile</th>
            <th>Status</th>
            <th class="d-print-none">Show</th>--}}
            <th class="d-print-none">Edit</th>
            <th class="d-print-none">Del</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
        <tr>
            <td><a href="member/{{ $member->id }}"><span data-feather="arrow-right-circle" class="small text-success"></span></a>{{ $member->id}}</td>
            <td>{{ $member->fname.' '.$member->lname }}</td>
            <td>{{ $member->mobile }}</td>
            <td>{{ $member->email }}</td>
           {{-- <td>{{ $member->address }}</td>
            <td>{{ $member->dob }}</td>
            <td>{{ $member->spouse_name }}</td>
            <td>{{ $member->spouse_mobile }}</td>
            <td>{{ ($member->status ? 'active' : 'inactive') }}</td>
            <td><a href="{{ 'member/'.$member->id }}">Show</a> </td>--}}
            <td><a href="{{ 'member/'.$member->id.'/edit' }}">Edit</a> </td>
            <td><a href="{{ 'member/'.$member->id }}">Delete</a> </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container-fluid align-content-lg-center">
        {{ $members->links() }}
    </div>

@endsection
