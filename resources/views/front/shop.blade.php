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
                    <div class="sub-title">
                        <h2 style="background-color: #f8ede8">SubCategories</h2>
                    </div>

                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $key => $category)
                                        <div class="accordion-item">

                                            @if ($category->sub_category->isNotEmpty())
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne-{{ $key }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapseOne-{{ $key }}">
                                                        {{ $category->name }}
                                                    </button>
                                                </h2>
                                            @else
                                                <a href="{{ route('front.shop', $category->slug) }}"
                                                    class="nav-item nav-link  {{ $categorySelected == $category->id ? 'text-primary' : '' }}">{{ $category->name }}</a>
                                            @endif

                                            @if ($category->sub_category->isNotEmpty())
                                                <div id="collapseOne-{{ $key }}"
                                                    class="accordion-collapse collapse  {{ $categorySelected == $category->id ? 'show' : '' }}"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="navbar-nav">
                                                            @foreach ($category->sub_category as $sub_category)
                                                                <a href="{{ route('front.shop', [$category->slug, $sub_category->slug]) }}"
                                                                    class="nav-item nav-link  {{ $subCategorySelected == $sub_category->id ? 'text-primary' : '' }}">{{ $sub_category->name }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    @endforeach
                                @endif



                            </div>
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2 style="background-color: #f8ede8">Brands</h2>
                    </div>

                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body">
                            @if ($brands->isNotEmpty())
                                @foreach ($brands as $brand)
                                    <div class="form-check mb-2">
                                        <input {{ in_array($brand->id, $brandArray) ? 'checked' : '' }}
                                            class="form-check-input brand-label" name="brand[]" type="checkbox"
                                            value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                        <label class="form-check-label" for="brand-{{ $brand->id }}">
                                            {{ $brand->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="sub-title mt-5">
                        <h2 style="background-color: #f8ede8">Price</h2>
                    </div>

                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body">
                            <input type="text" class="js-range-slider" name="my_range" value="" />
                        </div>
                    </div>


                </div>


                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <div class="ml-2">
                                    <div class="btn-group">
                                        <select name="sort" id="sort" class="form-control">
                                            <option value="latest" {{($sort=='latest')? 'selected':''}}>Latest</option>
                                            <option value="price_desc" {{($sort=='price_desc')? 'selected':''}}>Price High</option>
                                            <option value="price_asc" {{($sort=='price_asc')? 'selected':''}}>Price Low</option>
                                        </select>
                                    </div>
                                </div>




                            </div>
                        </div>
                        @if ($products->isNotEmpty())
                            @foreach ($products as $row)
                                <div class="col-md-4">
                                    <div class="card product-card" style="border-radius: 10px;">
                                        <div class="product-image position-relative" style="border-radius: 10px;">
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

                                            <div class="card-body text-center">
                                                <a class="h6 link" href="product.php">{{ $row->title }}</a>
                                                <div class="price mt-2">
                                                    <span class="h5"><strong>${{ $row->price }}</strong></span>
                                                    <span
                                                        class="h6 text-underline"><del>${{ $row->compare_price }}</del></span>
                                                </div>
                                                <div
                                                    class="button-container d-flex justify-content-center align-items-center mt-3">
                                                    <form action="{{ route('front.store', $row->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <button class="btn btn-warning"
                                                            style="border-radius: 10px; height: 40px; margin-right:20px"
                                                            type="submit">Add To Cart</button>
                                                    </form>
                                                    <a href="{{ route('front.checkout2', $row->slug) }}"
                                                        class="btn btn-primary"
                                                        style="border-radius: 10px; height: 40px;">Buy Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('customjs')
    <script>
        rangeSlider = $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 1000,
            from: {{ $priceMin }},
            step: 10,
            to: {{ $priceMax }},
            skin: "round",
            max_postfix: "+",
            Prefix: "$",
            onFinish: function() {
                apply_filters();
            }
        });


        $("#sort").change(function(){
            apply_filters();
        })

        // Saving its instance to a var
        var slider = $(".js-range-slider").data("ionRangeSlider");

        $(".brand-label").change(function() {
            apply_filters();
        });

        function apply_filters() {
            var brands = [];
            $(".brand-label").each(function() {
                if ($(this).is(":checked") == true) {
                    brands.push($(this).val());
                }
            });

            var url = '{{ url()->current() }}?';

            url += 'price_min=' + slider.result.from + '&price_max=' + slider.result.to;

            url +='&sort='+$("#sort").val();

            if (brands.length > 0) {
                url += '&brand=' + brands.toString();
            }

            window.location.href = url;
        }
    </script>
@endsection
