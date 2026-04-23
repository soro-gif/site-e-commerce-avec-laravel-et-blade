@extends('admin')

@section('content')
    <div >
        <h3>Edit User</h3>
        <a href="{{ route('admin.user.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('users/userForm', ['user' => $user])
    </div>
@endsection