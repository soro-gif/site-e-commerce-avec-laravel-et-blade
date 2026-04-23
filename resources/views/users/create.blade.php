@extends('admin')

@section('content')
<div >
    <h3>Create User</h3>
    <a href="{{ route('admin.user.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('users/userForm')
        </div>
@endsection
