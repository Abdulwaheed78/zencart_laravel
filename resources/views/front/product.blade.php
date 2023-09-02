@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3" style="background-color:#f8ede8">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                    <li class="breadcrumb-item">{{ $product->title }}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3 mt-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light" style="border-radius: 10px; background-color:#f8ede8">
                            @if (!empty($product->images))
                                @foreach ($product->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img class="w-100 h-100" src="{{ asset('storage/' . $image->image) }}"
                                            alt="Image" style=" border-radius:10px;">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item">
                                    <img class="w-100 h-100" src="{{ asset('front-assets/images/product-1.jpg') }}"
                                        alt="Image">
                                </div>
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class=" right" style="background-color: #f8ede8">
                        <h1>{{ $product->title }}</h1>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>
                        @if ($product->compare_price > 0)
                            <h2 class="price text-secondary"><del>${{ $product->compare_price }}</del></h2>
                        @endif
                        <h2 class="price ">${{ $product->price }}</h2>

                        <p>{{ $product->short_desc }}</p>



                        <div class="button-container d-flex justify-content-center align-items-center mt-5">
                            <form action="{{ route('front.store', $product->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <button class="btn btn-warning" style="border-radius: 10px; height: 40px; margin-right:50px" type="submit"><small>Add To Cart</small></button>
                            </form>
                            <div style="width: 10px;"></div> <!-- 10px gap -->
                            <a href="{{ route('front.checkout2', $product->slug) }}" class="btn btn-primary" style="border-radius: 10px; height: 40px; margin-right:330px;"><small>Buy Now</small></a>
                        </div>


                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="" style="background-color: #f8ede8">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active"style="border-radius:10px" id="description-tab"
                                    data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab"
                                    aria-controls="description" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping"
                                    type="button" style="border-radius:10px" role="tab" aria-controls="shipping"
                                    aria-selected="false">Shipping &
                                    Returns</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                    type="button" style="border-radius:10px" role="tab" aria-controls="reviews"
                                    aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-2" id="myTabContent" style="border-radius:10px">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <p>
                                    {{ $product->description }}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                <p>{{ $product->shipping_returns }}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--releted  products section-->
    <section class="pt-5 section-8">
        <div class="container">
            <div class="section-title">
                <h2 style="background-color: #f8ede8">Related Products</h2>
            </div>
            <div class="row pb-3">
                @foreach ($relatedProducts as $key => $rel_product)
                    <div class="col-md-3">
                        <div class="card product-card" style="border-radius: 10px;">
                            <div class="product-image position-relative">
                                <center><a href="{{ route('front.product', $rel_product->slug) }}" class="product-img">
                                        <img class="card-img-top mt-2"
                                            src="{{ asset('storage/' . $rel_product->images[0]->image) }}" alt=""
                                            style="width:280px; height: 300px; border: 10px; border-radius: 10px;">
                                    </a></center>



                            </div>
                            <div class="card-body text-center ">
                                <a class="h6 link" href="">{{ $rel_product->title }}</a>
                                <div class="price mt-2">
                                    <span class="h5"><strong>${{ $rel_product->price }}</strong></span>
                                    @if ($rel_product->compare_price > 0)
                                        <span
                                            class="h6 text-underline"><del>{{ $rel_product->compare_price }}</del></span>
                                    @endif
                                </div>

                                <div class="button-container d-flex justify-content-center align-items-center mt-3">
                                    <form action="{{ route('front.store', $product->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <button class="btn btn-warning" style="border-radius: 10px; height: 40px;margin-right:20px"
                                            type="submit"><small>Add To Cart</small></button>
                                    </form>
                                    <a href="{{ route('front.checkout2', $product->slug) }}" class="btn btn-primary"
                                        style="border-radius: 10px; height: 40px;"><small>Buy Now</small></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>

        <!--        <div class="container">
                                                                <div class="section-title">
                                                                    <h2>Related Products</h2>
                                                                </div>
                                                                <div class="col-md-12">


                                                                -->

        </div>
        </div>
    </section>


@endsection



@section('customjs')
@endsection
