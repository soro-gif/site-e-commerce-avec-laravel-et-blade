@extends('admin')

@section('content')
<div >
    <h3>Create Social</h3>
    <a href="{{ route('admin.social.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('socials/socialForm')
        </div>
@endsection
