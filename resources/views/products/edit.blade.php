@extends('admin')

@section('content')
    <div >
        <h3>Edit Product</h3>
        <a href="{{ route('admin.product.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('products/productForm', ['product' => $product])
    </div>
@endsection