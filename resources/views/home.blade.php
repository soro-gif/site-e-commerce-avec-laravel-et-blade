@extends('base')
@section('content')
@include('lstore.components.banner')
    <div  class="main_content">
        @include('lstore.components.collection')
        <div  class="section small_pt pb_70">
            <div  class="container">
                <div  class="row justify-content-center">
                    <div  class="col-md-6">
                        <div  class="heading_s1 text-center">
                            <h2 >Exclusive Products</h2>
                        </div>
                    </div>
                </div>
                <div  class="row">
                    <div  class="col-12">
                        <div  class="tab-style1">
                            <ul  role="tablist" class="nav nav-tabs justify-content-center">
                                <li  class="nav-item"><a 
                                        id="arrival-tab" data-bs-toggle="tab" href="#arrival" role="tab"
                                        aria-controls="arrival" aria-selected="true" class="nav-link active">New
                                        Arrival</a></li>
                                <li  class="nav-item"><a 
                                        id="sellers-tab" data-bs-toggle="tab" href="#sellers" role="tab"
                                        aria-controls="sellers" aria-selected="false" class="nav-link">Best Sellers</a>
                                </li>
                                <li  class="nav-item"><a 
                                        id="featured-tab" data-bs-toggle="tab" href="#featured" role="tab"
                                        aria-controls="featured" aria-selected="false" class="nav-link">Featured</a>
                                </li>
                                <li  class="nav-item"><a 
                                        id="special-tab" data-bs-toggle="tab" href="#special" role="tab"
                                        aria-controls="special" aria-selected="false" class="nav-link">Special Offer
                                    </a></li>
                            </ul>
                        </div>
                        <div  class="tab-content">
                            <div  id="arrival" role="tabpanel" aria-labelledby="arrival-tab"
                                class="tab-pane fade show active">
                                <div  class="row shop_container">
                                    @foreach ($newArrivals as $product)
                                    <div  class="col-lg-3 col-md-4 col-6">
                                        @include('lstore/components/product-item')
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div  id="sellers" role="tabpanel" aria-labelledby="sellers-tab"
                                class="tab-pane fade">
                                <div  class="row shop_container">
                                    @foreach ($bestSellers as $product)
                                    <div  class="col-lg-3 col-md-4 col-6">
                                        @include('lstore/components/product-item')
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div  id="featured" role="tabpanel"
                                aria-labelledby="featured-tab" class="tab-pane fade">
                                <div  class="row shop_container">
                                    @foreach ($featured as $product)
                                    <div  class="col-lg-3 col-md-4 col-6">
                                        @include('lstore/components/product-item')
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div  id="special" role="tabpanel" aria-labelledby="special-tab"
                                class="tab-pane fade">
                                <div  class="row shop_container">
                                    @foreach ($specialOffers as $product)
                                    <div  class="col-lg-3 col-md-4 col-6">
                                        @include('lstore/components/product-item')
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection