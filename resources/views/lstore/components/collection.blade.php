        <div  class="section pb_20">
            <div  class="container">
                <div  class="row">
                    @foreach ($collections as $collection)
                        <div  class="col-md-6">
                            <div  class="single_banner"><img 
                                    alt="shop_banner_img1"
                                    src="{{Storage::url($collection->imageUrl)}}">
                                <div  class="single_banner_info">
                                    <h5  class="single_bn_title1">{{$collection->title}}</h5>
                                    <h3  class="single_bn_title">{{$collection->description}}</h3><a
                                        class="single_bn_link"
                                        href="{{$collection->buttonLink}}">{{$collection->buttonText}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- <div  class="col-md-6">
                        <div  class="single_banner"><img 
                                alt="shop_banner_img1"
                                src="/assets/files/1231816139442978863631268994779183882351500061684757886381.png">
                            <div  class="single_banner_info">
                                <h5  class="single_bn_title1">Super Sale</h5>
                                <h3  class="single_bn_title">New Collection</h3><a
                                     class="single_bn_link"
                                    href="http://localhost:4400/">Shop Now</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>