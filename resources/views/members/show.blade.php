@extends('layouts.app')
@section('title','Members')
@section('content')



    <div class="container py-3 text-center">
        <div class="d-none d-print-block">
            <h2>{{env('ORG_NAME')}} </h2>
            <h3>{{env('ORG_ADDRESS')}} </h3>
            <p>{{env('ORG_EMAIL').' | '.env('ORG_PHONE')}} </p>
        </div>
        <h2>
            {{ $member->fname.' '.$member->lname }}
            <br><a href="{{ route('member.edit',$member->id) }}" class="btn btn-sm btn-success text-left">Edit Member</a>
        </h2>
        <div class="pageNo d-print-none text-center">
            <a href="{{ ($member->id>1)? $member->id-1:$member->id }}"><span data-feather="arrow-left-circle" class="small text-dark"></span></a>
            <span class="text-dark">{{$member->id}}</span>
            <a href="{{ ($member->id<$totalmember) ? $member->id+1:$member->id }}"><span data-feather="arrow-right-circle" class="small text-dark"></span></a>
        </div>

    </div>

    <table class="table table-hover table-striped table-bordered">
        <tbody>

        <tr>
            <td class="text-right" width="50%">Phone</td>
            <td class="text-left">{{ $member->mobile }}</td>
        </tr>
        <tr>
            <td class="text-right" width="50%">Email</td>
            <td class="text-left">{{ $member->email }}</td>
        </tr>
        <tr>
            <td class="text-right" width="50%">Address</td>
            <td class="text-left">{{ $member->address }}</td>
        </tr>
        <tr>
            <td class="text-right" width="50%">DOB</td>
            <td class="text-left">{{ $member->dob }}</td>
        </tr>
        <tr>
            <td class="text-right" width="50%">Spouse Name</td>
            <td class="text-left">{{ $member->spouse_name }}</td>
        </tr>
        <tr>
            <td class="text-right" width="50%">Spouse Mobile</td>
            <td class="text-left">{{ $member->spouse_mobile }}</td>
        </tr>
        <tr>
            <td class="text-right" width="50%">Joined On</td>
            <td class="text-left">{{ $member->joined_on }}</td>
        </tr>
        <tr>
            <td class="text-right" width="50%">Left On</td>
            <td class="text-left">{{ $member->left_on }}</td>
        </tr>
        <tr>
            <td class="text-right" width="50%">Category</td>
            <td class="text-left">{{ $member->category->name  }}</td>
        </tr>
        <tr>
            <td class="text-right" width="50%">Status</td>
            <td class="text-left">{{ ($member->status ? 'active' : 'inactive') }}</td>
        </tr>

        </tbody>
    </table>




@endsection

