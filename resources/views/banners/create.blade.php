@extends('admin')

@section('content')
<div >
    <h3>Create Banner</h3>
    <a href="{{ route('admin.banner.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('banners/bannerForm')
        </div>
@endsection
