<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Shop Serenity</title>
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />

    <meta property="og:locale" content="en_AU" />
    <meta property="og:type" content="website" />
    <meta property="fb:admins" content="" />
    <meta property="fb:app_id" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:image:alt" content="" />

    <meta name="twitter:title" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:image:alt" content="" />
    <meta name="twitter:card" content="summary_large_image" />


    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/video-js.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap"
        rel="stylesheet">

    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />



</head>


<body data-instant-intensity="mousedown" style="background-color:#f8ede8">
    <div class=" top-header" style="background-color:#f8ede8">
        <div class="container">
            <div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
                <div class="col-lg-4 logo">
                    <a href="{{ route('front.home') }}" class="text-decoration-none">
                        <span class="h1 text-dark  px-2">ShopSerenity</span>

                    </a>
                </div>

                <div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
                    <form action="{{ route('front.search') }} " method="get">

                        <div class="input-group input-group" style="width: 500px; ">

                            <input type="text" placeholder="Search Products" name="search"
                                style="border-radius:10px;" class="form-control float-right" placeholder="Search"
                                width="40%" style="margin-right:10px">

                            <div class="input-group-append">
                                <button type="submit" class=" form-control btn btn-default"
                                    style="border-radius: 5px">
                                    <i class="fas fa-search" style="font-size:20px;"></i>
                                </button>
                            </div>

                            <div class="right-nav py-0">
                                <a href="{{ route('front.shop') }}" class=" d-flex pt-2">
                                    <i class="fas fa-shopping-bag text-dark"
                                        style="font-size:20px; margin-left:20px"></i>
                                </a>
                            </div>


                            <div class="right-nav py-0">
                                <a href="{{ route('front.cart') }}" class=" d-flex pt-2">
                                    <i class="fas fa-shopping-cart text-dark"
                                        style="font-size:20px; margin-left:25px"></i>
                                </a>
                            </div>


                            <div class="right-nav py-0">
                                <a href="{{ route('front.profile') }}" class="nav-link text-dark"><i
                                        class="fas fa-user text-dark"
                                        style="font-size:20px; margin-left:20px"></i></a>
                            </div>





                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>






    <header class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-xl" id="navbar">
                <a href="index.php" class="text-decoration-none mobile-logo">
                    <span class="h2  text-white bg-dark">ShopSerenity</span>

                </a>
                <button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon icon-menu"></span> -->
                    <i class="navbar-toggler-icon fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php" title="Products">Home</a>
        </li> -->
                        @foreach (getCategories() as $category)
                            <li class="nav-item ">
                                <a class="dropdown-item nav-link "
                                    href="{{ route('front.shop', $category->slug) }}"><img
                                        style="heught:40px;width:40px; border-radius:5px"
                                        src="{{ asset('Storage/' . $category->image) }}"
                                        alt="Not Found">{{ $category->name }}</a>
                            </li>
                        @endforeach




                    </ul>
                </div>

            </nav>
        </div>
    </header>







    <main style="background-color: #f8ede8">

        @yield('content')
    </main>

    <footer class=" mt-5" style="background-color:#212529 ">
        <div class="container pb-5 pt-3" style="background-color: #212529">
            <div class="row" style="background-color: #212529">
                <div class="col-md-4">
                    <div class="footer-card text-dark">
                        <h3 class="text-white">Get In Touch</h3>
                        <p class="text-white">ShopSerenity
                            456 Peaceful Lane <br>
                            Serene City, Mumbai <br>
                            Maharashtra,India <br>
                            400001
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card text-dark">
                        <h3 class="text-white">Important Links</h3>
                        <ul class="text-dark">
                            <li><a class="text-white" href="{{ route('front.about') }}" title="About">About</a>
                            </li>
                            <li><a class="text-white" href="{{ route('front.contact') }}" title="Contact Us">Contact
                                    Us</a></li>
                            <li><a href="#" class="text-white" title="Privacy">Privacy</a></li>
                            <li><a href="#" class="text-white" title="Privacy">Terms & Conditions</a></li>
                            <li><a href="#"class="text-white" title="Privacy">Refund Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card text-dark">
                        <h3 class="text-white">My Account</h3>
                        <ul class="text-dark">
                            <li><a class="text-white" href="{{ route('login') }}" title="Sell">Login</a></li>
                            <li><a class="text-white" href="{{ route('auth.register') }}"
                                    title="Advertise">Register</a></li>
                            <li><a class="text-white" href="{{ route('front.orders') }}" title="Contact Us">My
                                    Orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area" style="background-color:#f8ede8 ">

            <div class="container">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="copy-right text-center">
                            <strong>
                                <p class="text-dark">© Copyright 2022 ShopSerenity. All Rights Reserved</p>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/custom.js') }}"></script>
    <script>
        window.onscroll = function() {
            myFunction()
        };

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('customjs')
</body>

</html>
