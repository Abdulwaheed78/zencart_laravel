@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 " style="background-color: #f8ede8">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                    <li class="breadcrumb-item">Cart</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-9 pt-4">

        <div class="container">
            <div class="row"  style="height: 520px">
                <div class="col-md-8">
                    @if (session('error'))
                        <center>
                            <p class="text-danger mt-3" id="error-message">
                                {{ session('error') }}
                            </p>
                        </center>
                    @elseif (session('success'))
                        <center>
                            <p class="text-success mt-3" id="error-message">
                                {{ session('success') }}
                            </p>
                        </center>
                    @endif
                    <div class="table-responsive">
                        <table class="table" id="cart">
                            <thead >
                                <tr style="background-color: #001d3d; border-radius: 10px; height: 10px;">
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>


                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cart as $key => $row)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <img src="{{ asset('storage/' . $row->productimage) }}" width=""
                                                    height="">
                                                <h2>{{ $row->producttitle }}</h2>
                                            </div>
                                        </td>
                                        <td>${{ $row->productprice }}</td>
                                       {{-- <td class="cart-product-quantity" width="130px">
                                            <div class="input-group quantity">
                                                <div class="input-group-prepend decrement-btn" style="cursor: pointer">
                                                    <span class="input-group-text">-</span>
                                                </div>
                                                <input type="text" class="qty-input form-control" maxlength="2"
                                                    max="10" value="{{ $row->quantity }}"
                                                    data-cart-id="{{ $row->id }}">
                                                <div class="input-group-append increment-btn" style="cursor: pointer">
                                                    <span class="input-group-text">+</span>
                                                </div>
                                            </div>
                                        </td>--}}
                                        <td>{{ $row->quantity }}</td>
                                        <td>
                                            $ {{ $row->productprice * $row->quantity }}
                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-danger"><a style="color:aliceblue"
                                                    href="{{ route('cart.delete', $row->id) }}">x</a></i></button>
                                        </td>
                                    </tr>
                                    @php
                                        $total += $row->productprice;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="card cart-summery" style="border-radius: 10px;">
                        <div class="sub-title">
                            <h2 class="bg-white">Cart Summery</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2">
                                <div>Subtotal</div>
                                <div>${{ $total }}</div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div>Shipping</div>
                                <div>$20</div>
                            </div>

                            <div class="d-flex justify-content-between summery-end">
                                <div>Total</div>
                                <div>{{ $total + 20 }}</div>

                                {{-- {{$row[$key]->sum('prouctquantity')}} --}}
                            </div>

                            <div class="pt-5">
                                <a style="border-radius: 10px;" href="{{ route('front.checkout') }}" class="btn-dark btn btn-block w-100">Proceed to
                                    Checkout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('customjs')
    <script>
        $(document).ready(function() {

            $('.increment-btn').click(function(e) {
                e.preventDefault();
                var incre_value = $(this).parents('.quantity').find('.qty-input').val();
                var value = parseInt(incre_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value < 10) {
                    value++;
                    $(this).parents('.quantity').find('.qty-input').val(value);
                }

            });

            $('.decrement-btn').click(function(e) {
                e.preventDefault();
                var decre_value = $(this).parents('.quantity').find('.qty-input').val();
                var value = parseInt(decre_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $(this).parents('.quantity').find('.qty-input').val(value);
                }
            });

        });
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Hide the error message after 2 seconds  for messages
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 3000);
    </script>
@endsection
