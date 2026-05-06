@extends('admin')

@section('content')
    <div >
        <h3>Edit Tag</h3>
        <a href="{{ route('admin.tag.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('tags/tagForm', ['tag' => $tag])
    </div>
@endsection