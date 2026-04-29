
    <div  class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
        <div  id="carouselExampleControls" data-bs-ride="carousel"
            class="carousel slide carousel-fade light_arrow">
            <div  class="carousel-inner">
                @foreach($banners as $banner)
                    <div  class="carousel-item {{ $loop->first ? 'active' : '' }} background_bg"
                        data-img-src="{{Storage::url($banner->imageUrl)}}"
                        style="background-image: url({{Storage::url($banner->imageUrl)}});">
                        <div  class="banner_slide_content">
                            <div  class="container">
                                <div  class="row">
                                    <div  class="col-lg-7 col-9">
                                        <div  class="banner_content overflow-hidden">
                                            <h5  data-animation="slideInLeft"
                                                data-animation-delay="0.5s"
                                                class="mb-3 staggered-animation font-weight-light animated slideInLeft"
                                                style="animation-delay: 0.5s; opacity: 1;">{{$banner->description}}</h5>
                                            <h2  data-animation="slideInLeft"
                                                data-animation-delay="1s" class="staggered-animation animated slideInLeft"
                                                style="animation-delay: 1s; opacity: 1;">{{$banner->title}}</h2><a
                                                data-animation="slideInLeft"
                                                data-animation-delay="1.5s"
                                                class="btn btn-fill-out rounded-0 staggered-animation text-uppercase animated slideInLeft"
                                                href="{{$banner->buttonLink}}"
                                                style="animation-delay: 1.5s; opacity: 1;">{{$banner->buttonText}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div><a  href="#carouselExampleControls" role="button" data-bs-slide="prev"
                class="carousel-control-prev"><i  class="ion-chevron-left"></i></a><a
                 href="#carouselExampleControls" role="button" data-bs-slide="next"
                class="carousel-control-next"><i  class="ion-chevron-right"></i></a>
        </div>
    </div>