@extends('layouts.app')
@section('title','Import Members')

@section('content')
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Payment Import [ CSV ]
        </h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismisable">
                {{Session::get('message')}}
            </div>
        @endif

        <form action="{{ route('importpayment') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import data</button>
            {{--<a class="btn btn-success" href="{{ route('file-export') }}">Export data</a>--}}
        </form>
    </div>
@endsection
