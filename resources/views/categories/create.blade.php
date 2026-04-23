@extends('admin')

@section('content')
<div >
    <h3>Create Category</h3>
    <a href="{{ route('admin.category.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('categories/categoryForm')
        </div>
@endsection
