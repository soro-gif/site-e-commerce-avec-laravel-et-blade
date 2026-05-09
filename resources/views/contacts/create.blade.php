@extends('admin')

@section('content')
<div >
    <h3>Create Contact</h3>
    <a href="{{ route('admin.contact.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('contacts/contactForm')
        </div>
@endsection
