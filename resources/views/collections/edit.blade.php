@extends('admin')

@section('content')
    <div >
        <h3>Edit Collection</h3>
        <a href="{{ route('admin.collection.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('collections/collectionForm', ['collection' => $collection])
    </div>
@endsection