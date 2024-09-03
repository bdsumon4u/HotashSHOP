<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="https://www.sigma-oil.com/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>High Quality Engine Oil - Lubricant Company in Bangladesh | {{$company->name}}</title>
    <meta name="description"
        content="Keeping personal or business vehicle (bus, truck, car or fleet) running smoothly is so important. SAAH Traders produces &amp; supplies top quality engine &amp; motorcycle lubricant oils in Bangladesh" />
    <meta name="keywords" content="" />
    
    <!-- Opengraph data -->
    <meta property="og:title"
        content="Fastest Growing Lubricant Oil Company in Bangladesh | SAAH Traders">
    <meta property="og:site_name" content="SAAH Traders">
    <meta property="og:url" content="https://www.sigma-oil.com/">
    <meta property="og:description"
        content="Keeping your trucks, buses or fleet running smoothly is crucial for your business. SAAH Traders produces & supplies a wide range of quality engine & motorcycle lubricant oils i">
    <meta property="og:type" content="website">
    <!-- Opengraph data -->
    <meta property="og:image" content="https://www.sigma-oil.com/images/og.jpg">
    <meta name="robots" content="index, follow" />
    <meta name="theme-color" content="#002776">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.sigma-oil.com/images/sigma-favicon.ico">

    <link rel="preload" href="https://www.sigma-oil.com/images/background/sigma-factory-sm.webp" as="image">
    <link rel="preload" href="https://www.sigma-oil.com/images/background/industrial-engine-oil-main-sm.jpg"
        as="image">
    <link rel="preload" href="https://www.sigma-oil.com/images/background/heavy-duty-engine-oil-main-sm.jpg"
        as="image">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="/inc/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" integrity="sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="preload" as="style"
        onload="this.rel='stylesheet'">


    <link rel="stylesheet" href="/inc/style.css" type="text/css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    @php $parentCategories = categories(null) @endphp
    <div class="dvLayout">
        <header class="header-area">
            <div class="container-fluid">
                <div class="header-wrapper">
                    <div class="hamburger-wrapper">
                        <div class="hamburger"><i class="fa fas fa-bars"></i></div>
                    </div>
                    <div class="logo">
                        <a href="/"><img
                                src="{{ asset($logo->desktop ?? '') }}" width="188" height="222"
                                title="SAAH Traders" alt="SAAH Traders Logo"></a>
                    </div>
                    <div class="top-bar-right">
                        <!--Header-Lower-->
                        <div class="custom-menu">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <a class="small-phone d-lg-none" href="tel:{{$company->phone??''}}"><i class="fa fa-phone"></i>
                                    <span>{{$company->phone??''}}</span></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li>
                                            <a href="{{ route('distributors.index') }}"> Our Distributors </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('products.index') }}"> All Products </a>
                                        </li>

                                        @foreach($parentCategories as $category)
                                        <li @if($category->childrens->isNotEmpty()) class="dropdown" @endif>
                                            <a href="{{ route('categories.products', $category) }}">{{$category->name}}</a>
                                            @if($category->childrens->isNotEmpty())
                                            <ul class="dropdown-menu">
                                                @foreach($category->childrens as $category)
                                                <li @if($category->childrens->isNotEmpty()) class="dropdown" @endif>
                                                    <a href="{{ route('categories.products', $category) }}">{{$category->name}}</a>
                                                    @if($category->childrens->isNotEmpty())
                                                    <ul class="sub-sub-navs dropdown-menu">
                                                        @foreach($category->childrens as $category)
                                                        <li>
                                                            <a href="{{ route('categories.products', $category) }}">{{$category->name}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!--/.Navbar -->
                        <div class="right-box">
                            <div class="call-us">
                                <div class="icon"><i class="fa fas fa-phone"></i></div>
                                <div class="call-us-text">
                                    <span>Call Us Today</span>
                                    <span class="f-number">{{$company->phone??''}}</span>
                                </div>
                                <a href="tel:{{$company->phone??''}}" aria-label="Phone Number"><span
                                        class="d-none">{{$company->phone??''}}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Left Navigation -->
        <div class="dvLeft">
            <div id="slidebar-out" class="dvside-out"><i class="fa fa-times"></i></div>
            <div class="dwr_logo"><a href="/"><img
                        src="{{ asset($logo->desktop ?? '') }}" width="188" height="222"
                        title="SAAH Traders" alt="SAAH Traders Logo"
                        class="logo-bottom"></a></div>
            <nav class="navigation" id="menubar">
                <ul class="nav flex-column flex-nowrap" id="ulmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('distributors.index') }}"> <i class="fa fa-angle-right" aria-hidden="true"></i> Our Distributors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}"> <i class="fa fa-angle-right" aria-hidden="true"></i> All Products</a>
                    </li>
                    @foreach($parentCategories as $category)
                    <li class="nav-item mainDropdown ">
                        <a class="nav-link @if($category->childrens->isNotEmpty()) collapsed @endif" href="{{ route('categories.products', $category) }}">{{$category->name}}</a>
                        @if($category->childrens->isNotEmpty())
                        <span role="button" data-toggle="collapse" data-target_="#subsubmenu-{{$category->id}}" class="fa fa-plus sub" aria-expanded="false"></span>
                        <div class="collapse" id="subsubmenu-{{$category->id}}">
                            <ul class="flex-column pl-2 nav">
                                @foreach($category->childrens as $category)
                                <li class="nav-item subDropdown">
                                    <a class="nav-link @if($category->childrens->isNotEmpty()) collapsed @endif" href="{{ route('categories.products', $category) }}">{{$category->name}}</a>
                                    @if($category->childrens->isNotEmpty())
                                    <span role="button" data-toggle="collapse" data-target_="#submenu-{{$category->id}}" class="fa fa-plus sub"></span>
                                    <div class="collapse" id="submenu-{{$category->id}}" aria-expanded="false">
                                        <ul class="flex-column nav pl-4">
                                            @foreach($category->childrens as $category)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('categories.products', $category) }}">{{$category->name}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>


        <div id="mainSiteContent">
            <section class="product area-padding">
                <div class="custom-container">
                    <div class="head-paragraph">
                        <span>*******</span>
                        <h2>Our Distributors</h2>
                    </div>
                    <div class="row no-gutters">
                        @foreach ($distributors as $distributor)
                        <div class="col-md-6 col-lg-3">
                            <div class="single-product">
                                <a href="tel:{{ $distributor->phone }}" target="_blank">
                                    <div class="overlay"></div>
                                    <img class=" lazyload"
                                        data-src="{{ $distributor->photo }}"
                                        src="#" width="460" height="380" alt="{{$distributor->type}}">
                                    <div class="single-product-content">
                                        <h3 class="d-block">{{$distributor->shop_name}}</h3>
                                        <p class="text-white">{{$distributor->full_name}} - {{$distributor->type}}</p>
                                        <div>
                                            {!! $distributor->address !!}
                                        </div>
                                        <div class="animated-btn">{{$distributor->phone}}</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <div class="container area-padding">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="area-heading text-center">
                            <h4 class="area-heading">Why Choose {{$company->name}}</h4>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="false"
                                            aria-controls="collapseOne">
                                            Use of Modern Technology
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        <p class="card-text">We use modern technology to process and refine products.
                                            It allows us to provide you with the right products.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Available All Over Bangladesh
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        <p class="card-text">We serve entire Bangladesh to meet oil needs in every
                                            corner of the country.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Quality Oil
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        <p class="card-text">Providing you with quality oil is our motto. Use our
                                            products and make your engines more efficient.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            Competitive Price
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                    data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        <p class="card-text">We offer competitive prices without compromising the
                                            quality of products.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseFive" aria-expanded="false"
                                            aria-controls="collapseFive">Wide Variety of Products</button>
                                    </h5>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                    data-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        <p class="card-text">We have a wide range of product categories so you can meet
                                            all your oil needs.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingSix">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseSix" aria-expanded="false"
                                            aria-controls="collapseSix">Smart Customer Service</button>
                                    </h5>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="card-text">Smart customer service to meet your requirements as a fuel
                                            station.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="call-to-action text-center">
                <div class="container">
                    <h3 class="h2">Get the Full Catalogs</h3>
                    <a class="animated-btn" target="_blank" rel="noopener"
                        href="{{route('products.index')}}"><i
                            class="fas fa-download"></i>All Products</a>
                </div>
            </section>
        </div>
        <footer class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <a href="https://www.sigma-oil.com/" rel="nofollow"><img class="lazyload"
                                    data-src="{{ asset($logo->desktop ?? '') }}"
                                    width="406" height="81" src="#"
                                    alt="SAAH Traders Logo"></a>
                            <div class="footer-social">
                                <div class="footer-title">Follow us:</div>
                                <ul>
                                    @foreach($social ?? [] as $item => $data)
                                        @if(($link = $data->link ?? false) && $link != '#')
                                        <li class="footer-newsletter__social-link footer-newsletter__social-link--{{ $item }}">
                                            <a href="{{ url($link ?? '#') }}" target="_blank">
                                                @switch($item)
                                                    @case('facebook')
                                                    <i class="fa fab fa-facebook-f"></i>
                                                    @break
                                                    @case('twitter')
                                                    <i class="fa fab fa-twitter"></i>
                                                    @break
                                                    @case('instagram')
                                                    <i class="fa fab fa-instagram"></i>
                                                    @break
                                                    @case('youtube')
                                                    <i class="fa fab fa-youtube"></i>
                                                    @break
                                                @endswitch
                                            </a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-title">OUR OIL</div>
                            <ul class="footer-list">
                                @foreach($menuItems as $item)
                                <li><a href="{{$item->href}}">{{$item->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-title">Head OFFICE</div>
                        <ul class="list-info">
                            <li>
                                <div class="info-icon">
                                    <i class="fa fas fa-map-marker"></i>
                                </div>
                                <div class="info-text"><a href="{{$company->gmap_ecode??''}}"
                                        rel="noopener nofollow" target="_blank">
                                        {{$company->address}}
                                    </a></div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-title">CONTACT</div>
                        <ul class="list-info">
                            <li>
                                <div class="info-icon">
                                    <i class="fa fas fa-envelope"></i>
                                </div>
                                <div class="info-text">
                                    <a href="mailto:{{$company->email??''}}" title="Mail Us Now" rel="nofollow">{{$company->email??''}}</a>
                                </div>
                            </li>
                            <li>
                                <div class="info-icon">
                                    <i class="fa fas fa-phone"></i>
                                </div>
                                <div class="info-text">
                                    <a href="tel:{{$company->phone??''}}" title="Call Us Now" rel="nofollow">{{$company->phone??''}}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row footer-bottom">
                    <div class="col-lg-6">
                        <ul class="footer-menu">
                            <li><a href="/about-us">Corporate</a><span>|</span></li>
                            <li><a href="/contact-us">Contact Us</a><span>|</span></li>
                            <li><a href="/privacy">Privacy Policy</a><span>|</span></li>
                            <li><a href="/webmail">Webmail</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <p>Copyright &copy;
                            2024 {{$company->name}} | All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        <div>
            <div class="backtotop"><i class="fa fas fa-chevron-up"></i></div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" defer="defer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" defer="defer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" defer="defer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" defer="defer"></script>
            <script defer="defer" src="https://www.sigma-oil.com/inc/js/main.js"></script>
        </div>
    </div>
</body>

</html>
