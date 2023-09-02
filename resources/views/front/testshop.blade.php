@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3" style="background-color: #f8ede8">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>



    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar">

                    <div class="card">
                        <div class="card-body">
                            <div class="sub-title">
                                <h2>Sub Categories</h2>
                            </div>
                            <div class="navbar-nav">
                                {{-- dd($subcategory->slug) --}}
                                @foreach ($subcategory as $sub)
                                    {{-- dd($$subcategory->slug) --}}
                                    @if ($subcategory)
                                        <a href="{{ route('category', [$category->slug, $sub->slug]) }}"
                                            value="{{ $sub->id }}"
                                            class="nav-item nav-link">{{ $sub->name }}</a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="sub-title mt-3">
                                <h2 >Brands</h3>
                            </div>
                            @foreach ($brands as $brand)
                                <a href="{{ route('category', ['categorySlug' => $category->slug, 'subcategorySlug' => $category->slug, 'brandSlug' => $brand->slug]) }}"
                                    class="nav-item nav-link">{{ $brand->name }}</a>
                            @endforeach
                        </div>
                    </div>

                </div>

                @if (isset($error))
                    <div class="alert alert-danger">{{ $error }}</div>
                @else
                    <div class="col-md-9">
                        <div class="row pb-3">
                            <div class="col-12 pb-1">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <div class="ml-2">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                                data-bs-toggle="dropdown">Sorting</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Latest</a>
                                                <a class="dropdown-item" href="#">Price High</a>
                                                <a class="dropdown-item" href="#">Price Low</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($products as $row)
                                <div class="col-md-4">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">

                                            <center>
                                                <a href="{{ route('front.product', $row->slug) }}" class="product-img">
                                                    @if (!empty($row->images[0]->image))
                                                        <img class="card-img-top mt-2"
                                                            src="{{ asset('storage/' . $row->images[0]->image) }}"
                                                            style="width:280px; height: 300px; border: 10px; border-radius: 10px;" />
                                                    @else
                                                        <img class="card-img-top rounded"
                                                            src="{{ asset('front-assets/images/product-1.jpg') }}"
                                                            style="width:280px; height: 300px; border: 10px; border-radius: 10px;" />
                                                    @endif
                                                </a>
                                            </center>

                                        </div>
                                        <div class="card-body text-center mt-3">
                                            <a class="h6 link" href="product.php">{{ $row->title }}</a>
                                            <div class="price mt-2">
                                                <span class="h5"><strong>${{ $row->price }}</strong></span>
                                                <span
                                                    class="h6 text-underline"><del>${{ $row->compare_price }}</del></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </section>
@endsection



@section('customJs')
@endsection
