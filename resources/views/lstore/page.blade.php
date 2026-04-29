@extends('base')

@section('title')
    {{ $page->title }} / Lstore
@endsection

@section('content')
@include('lstore.components.top-page', ['title' => $page->title])
<div class="container">
    {!! $page->content !!}
</div>

@endsection