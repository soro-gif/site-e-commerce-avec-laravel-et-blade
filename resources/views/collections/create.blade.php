@extends('admin')

@section('content')
<div >
    <h3>Create Collection</h3>
    <a href="{{ route('admin.collection.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('collections/collectionForm')
        </div>
@endsection
