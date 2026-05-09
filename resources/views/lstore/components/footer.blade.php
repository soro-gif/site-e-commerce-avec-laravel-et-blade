<footer  class="footer_dark">
    <div  class="footer_top">
        <div  class="container">
            <div  class="row">
                <div  class="col-lg-3 col-md-6 col-sm-12">
                    <div  class="widget">
                        <div  class="footer_logo"><a  href="{{ route('home') }}">
                                <h2 >{{ session()->get('settings')?->name }}</h2>
                            </a></div>
                        <p >{{ session()->get('settings')?->description }}</p>
                    </div>
                    <div  class="widget">
                        <ul  class="social_icons social_white">
                            @foreach (session()->get('socials') as $social)
                                <li ><a  target="_blank"
                                    href="{{ $social->link }}">
                                    <i class="{{ $social->icon }}"></i>
                                    </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div  class="col-lg-2 col-md-3 col-sm-6">
                    <div  class="widget">
                        <h6  class="widget_title">Useful Links</h6>
                        <ul  class="widget_links">
                            @foreach (session()->get('pages')['footPages'] as $page)
                                       
                            <li ><a 
                                    
                                    href="{{ route('page', ['page' => $page->slug]) }}">{{ $page->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div  class="col-lg-2 col-md-3 col-sm-6">
                    <div  class="widget">
                        <h6  class="widget_title">Category</h6>
                        <ul  class="widget_links">
                            <li ><a  href="#">Men</a></li>
                            <li ><a  href="#">Woman</a></li>
                            <li ><a  href="#">Kids</a></li>
                            <li ><a  href="#">Best Saller</a>
                            </li>
                            <li ><a  href="#">New Arrivals</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div  class="col-lg-2 col-md-6 col-sm-6">
                    <div  class="widget">
                        <h6  class="widget_title">My Account</h6>
                        <ul  class="widget_links">
                            <li ><a  routerlink="account"
                                    ng-reflect-router-link="account" href="/account">My Account</a></li>
                            <li ><a  routerlink="terms"
                                    ng-reflect-router-link="terms" href="/terms">Terms</a></li>
                            <li ><a  routerlink="signin"
                                    ng-reflect-router-link="signin" href="/signin">SignIn</a></li>
                            <li ><a  routerlink="signup"
                                    ng-reflect-router-link="signup" href="/signup">Signup</a></li>
                        </ul>
                    </div>
                </div>
                <div  class="col-lg-3 col-md-4 col-sm-6">
                    <div  class="widget">
                        <h6  class="widget_title">Contact Info</h6>
                        <ul  class="contact_info contact_info_light">
                            <li ><i 
                                    class="ti-location-pin"></i>
                                <p >
                                    {{ session()->get('settings')?->street }} 
                                    {{ session()->get('settings')?->codePostal }} 
                                    {{ session()->get('settings')?->city }}
                                </p>
                            </li>
                            <li ><i  class="ti-email"></i><a
                                     href="mailto:{{ session()->get('settings')?->email }}">{{ session()->get('settings')?->email }}</a>
                            </li>
                            <li ><i  class="ti-mobile"></i>
                                <p >{{ session()->get('settings')?->phone }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="bottom_footer border-top-tran">
        <div  class="container">
            <div  class="row">
                <div  class="col-md-6">
                    <p  class="mb-md-0 text-center text-md-start">
                          {{ session()->get('settings')?->copyright }}
                    </p>
                </div>
                <div  class="col-md-6">
                    <ul 
                        class="footer_payment text-center text-lg-end d-flex gap-2 justify-content-end">
                        <li ><a  href="#"><img
                                     src="assets/images/visa.png" alt="visa"></a></li>
                        <li ><a  href="#"><img
                                     src="assets/images/discover.png" alt="discover"></a>
                        </li>
                        <li ><a  href="#"><img
                                     src="assets/images/master_card.png"
                                    alt="master_card"></a></li>
                        <li ><a  href="#"><img
                                     src="assets/images/paypal.png" alt="paypal"></a></li>
                        <li ><a  href="#"><img
                                     src="assets/images/amarican_express.png"
                                    alt="amarican_express"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>