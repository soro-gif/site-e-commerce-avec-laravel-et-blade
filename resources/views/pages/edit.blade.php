@extends('admin')

@section('content')
    <div >
        <h3>Edit Page</h3>
        <a href="{{ route('admin.page.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('pages/pageForm', ['page' => $page])
    </div>
@endsection