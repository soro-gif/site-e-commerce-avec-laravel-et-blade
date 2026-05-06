@extends('admin')

@section('content')
    <div >
        <h3>Edit Megacollection</h3>
        <a href="{{ route('admin.megacollection.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('megacollections/megacollectionForm', ['megacollection' => $megacollection])
    </div>
@endsection