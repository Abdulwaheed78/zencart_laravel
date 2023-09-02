@extends('front.layouts.app')
@section('content')
    <!-- for carousel -->
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
            data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-1-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-1.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-1.jpg') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Kids Fashion</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-2-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-2.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-2.jpg') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <!-- <img src="images/carousel-3.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assetsimages/carousel-3-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-3.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-2.jpg') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded Clothes
                            </h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


    </section>
    <!-- normal cards section -->
    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg" style="border-radius: 10px;">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg"style="border-radius: 10px;">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg"style="border-radius: 10px;">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg"style="border-radius: 10px;">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- latest products section -->
    <section class="section-4 pt-5" style="margin-top:-35px">
        <div class="container">
            <div class="section-title">
                <h2 style="background-color: #f8ede8">Latest Produsts</h2>
            </div>
            <div class="row pb-3">
                @if ($latest->isNotEmpty())
                    @foreach ($latest as $product)
                        <div class="col-md-3">
                            <div class="card product-card" style="border-radius: 10px;">
                                <div class="product-image position-relative">
                                    <center> <a href="{{ route('front.product', $product->slug) }}" class="product-img">
                                            @if (!empty($product->images[0]->image))
                                                <img class="card-img-top mt-2"
                                                    src="{{ asset('storage/' . $product->images[0]->image) }}"
                                                    style="width:280px; height: 300px; border: 10px; border-radius: 10px;" />
                                            @else
                                                <img class="card-img-top mt-2"
                                                    src="{{ asset('front-assets/images/product-1.jpg') }}"
                                                    style="width:280px; height: 300px; border: 10px; border-radius: 10px;" />
                                            @endif
                                        </a></center>
                                </div>
                                <div class="card-body text-center">
                                    <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{ $product->price }}</strong></span>
                                        @if ($product->compare_price > 0)
                                            <span
                                                class="h6 text-underline"><del>${{ $product->compare_price }}</del></span>
                                        @endif
                                    </div>
                                    <div class="button-container d-flex justify-content-center align-items-center mt-3">
                                        <form action="{{ route('front.store', $product->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <button class="btn btn-warning"
                                                style="border-radius: 10px; height: 40px;  margin-right: 20px"
                                                type="submit"><small>Add To Cart</small></button>
                                        </form>
                                        <a href="{{ route('front.checkout2', $product->slug) }}" class="btn btn-primary"
                                            style="border-radius: 10px; height: 40px;"><small>Buy Now</small></a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- testing -->
    <!-- featured products section -->
    <section class="section-4 pt-5" style="margin-top:-60px">
        <div class="container" style="background-color: #f8ede8">
            <div class="section-title">
                <h2 style="background-color: #f8ede8">Featured Products</h2>
            </div>
            <div class="container">
                <div class="row pb-3">
                    @if ($featuredproducts->isNotEmpty())
                        @foreach ($featuredproducts as $product)
                            <div class="col-md-3">
                                <div class="card product-card" style="border-radius: 10px;">
                                    <div class="product-image position-relative" style="border-radius: 10px;">
                                        <center>
                                            <a href="{{ route('front.product', $product->slug) }}" class="product-img">
                                                @if (!empty($product->images[0]->image))
                                                    <img class="card-img-top img-fluid mt-2"
                                                        src="{{ asset('storage/' . $product->images[0]->image) }}"
                                                        style="width:280px; height: 300px; border: 10px; border-radius: 10px;" />
                                                @else
                                                    <img class="card-img-top rounded"
                                                        src="{{ asset('front-assets/images/product-1.jpg') }}"
                                                        style="width:280px; height: 300px; border: 10px; border-radius: 10px;" />
                                                @endif
                                            </a>

                                        </center>
                                    </div>
                                    <div class="card-body text-center">
                                        <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                        <div class="price mt-2">
                                            <span class="h5"><strong>${{ $product->price }}</strong></span>
                                            <span
                                                class="h6 text-underline"><del>${{ $product->compare_price }}</del></span>
                                        </div>
                                        <div
                                            class="button-container d-flex justify-content-center align-items-center mt-3">
                                            <form action="{{ route('front.store', $product->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button class="btn btn-warning"
                                                    style="border-radius: 10px; height: 40px; margin-right: 20px;"
                                                    type="submit"><small>Add To Cart</small></button>
                                            </form>
                                            <a href="{{ route('front.checkout2', $product->slug) }}"
                                                class="btn btn-primary"
                                                style="border-radius: 10px; height: 40px; "><small>Buy Now</small></a>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>



@endsection
@section('customjs')
@endsection
