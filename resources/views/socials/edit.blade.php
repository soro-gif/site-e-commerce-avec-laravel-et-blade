@extends('admin')

@section('content')
    <div >
        <h3>Edit Social</h3>
        <a href="{{ route('admin.social.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('socials/socialForm', ['social' => $social])
    </div>
@endsection