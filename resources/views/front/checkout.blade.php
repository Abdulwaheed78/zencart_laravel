@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 " style="background-color: #f8ede8">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            @if (isset($cart))
                <form action="{{ route('order.storecart') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8" style="height:900px">
                            <div class="sub-title">
                                <h2 style="background-color: #f8ede8">Shipping Address</h2>
                            </div>
                            @if ($userWithAddress != '')
                                <div class="card shadow-lg border-0" style="border-radius:10px;">
                                    <div class="card-body checkout-form">
                                        <div class="row">


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="first_name" required id="first_name"
                                                        value="{{ $userWithAddress->first_name }}" class="form-control"
                                                        placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="last_name"
                                                        value="{{ $userWithAddress->last_name }}" required id="last_name"
                                                        class="form-control" placeholder="Last Name">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="email"
                                                        value="{{ $userWithAddress->email }}" required id="email"
                                                        class="form-control" placeholder="Email">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <select name="country" required id="country" class="form-control">
                                                        <option value="">Select a Country ></option>
                                                        @foreach ($country as $key => $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <textarea name="address" required id="address" value="" cols="30" rows="3" placeholder="Address"
                                                        class="form-control">{{ $userWithAddress->address }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" value="{{ $userWithAddress->apartment }}"
                                                        name="apartment" id="appartment" class="form-control"
                                                        placeholder="Apartment, suite, unit, etc. (optional)">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required value="{{ $userWithAddress->city }}"
                                                        name="city" id="city" class="form-control"
                                                        placeholder="City">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required value="{{ $userWithAddress->state }}"
                                                        name="state" id="state" class="form-control"
                                                        placeholder="State">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required value="{{ $userWithAddress->zip }}"
                                                        name="zip" id="zip" class="form-control"
                                                        placeholder="Zip">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" required value="{{ $userWithAddress->mobile }}"
                                                        name="mobile" id="mobile" class="form-control"
                                                        placeholder="Mobile No.">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <textarea name="notes" id="notes" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card shadow-lg border-0" style="border-radius:10px;">
                                    <div class="card-body checkout-form">
                                        <div class="row">


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="first_name" required id="first_name"
                                                        class="form-control" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="last_name" required id="last_name"
                                                        class="form-control" placeholder="Last Name">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="email" required id="email"
                                                        class="form-control" placeholder="Email">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <select name="country" required id="country" class="form-control">
                                                        <option value="">Select a Country</option>
                                                        @foreach ($country as $key => $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}
                                                            </option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <textarea name="address" required id="address" value="" cols="30" rows="3"
                                                        placeholder="Address" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="apartment" id="appartment"
                                                        class="form-control"
                                                        placeholder="Apartment, suite, unit, etc. (optional)">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required name="city" id="city"
                                                        class="form-control" placeholder="City">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required name="state" id="state"
                                                        class="form-control" placeholder="State">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required name="zip" id="zip"
                                                        class="form-control" placeholder="Zip">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" required name="mobile" id="mobile"
                                                        class="form-control" placeholder="Mobile No.">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <textarea name="notes" id="notes" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="col-md-4">
                            <div class="sub-title">
                                <h2 style="background-color: #f8ede8">Order Summery</h3>
                            </div>
                            <div class="card cart-summery" style="border-radius:10px">
                                <div class="card-body">
                                    @php
                                        $subtotal = 0;
                                    @endphp

                                    @foreach ($cart as $key => $row)
                                        <div class="d-flex justify-content-between pb-2">
                                            <div class="h6">{{ $row->producttitle }}</div>
                                            <div class="h6">${{ $row->productprice }} x {{ $row->quantity }}
                                            </div>
                                            @php
                                                $subtotal += $row->productprice * $row->quantity;
                                            @endphp
                                        </div>
                                    @endforeach



                                    <div class="d-flex justify-content-between summery-end">
                                        <div class="h6"><strong>Subtotal</strong></div>
                                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                        <div class="h6"><strong>${{ $subtotal }}</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="h6"><strong>Shipping</strong></div>
                                        <input type="hidden" name="shipping" value="20">
                                        <div class="h6"><strong>$20</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 summery-end">
                                        <div class="h5"><strong>Total</strong></div>
                                        <input type="hidden" name="grand_total" value="{{ $subtotal + 20 }}">
                                        <div class="h5"><strong>${{ $subtotal + 20 }}</strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card payment-form " style="border-radius:10px">
                                <h3 class="card-title h5 mb-3">Payment Method</h3>
                                <div class="">
                                    <input checked type="radio" name="payment_method" value="cod"
                                        id="payment_method_one">
                                    <label for="payment_method_one" class="form-check-label">COD</label>
                                </div>
                                <div class="">
                                    <input type="radio" name="payment_method" value="stripe" id="payment_method_two">
                                    <label for="payment_method_two" class="form-check-label">Stripe</label>
                                </div>


                                <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                                    <div class="mb-3">
                                        <label for="card_number" class="mb-2">Card Number</label>
                                        <input type="text" name="card_number" id="card_number"
                                            placeholder="Valid Card Number" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="expiry_date" class="mb-2">Expiry Date</label>
                                            <input type="text" name="expiry_date" id="expiry_date"
                                                placeholder="MM/YYYY" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="expiry_date" class="mb-2">CVV Code</label>
                                            <input type="text" name="expiry_date" id="expiry_date" placeholder="123"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <button style="border-radius:10px;" type="submit" name="submit"
                                        class="btn-dark btn btn-block w-100">Pay
                                        Now</button>
                                </div>
                            </div>


                            <!-- CREDIT CARD FORM ENDS HERE -->

                        </div>
                    </div>
                </form>
            @elseif($product)
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8" style="height:900px">
                            <div class="sub-title">
                                <h2 style="background-color: #f8ede8">Shipping Address</h2>
                            </div>
                            @if ($userWithAddress != '')
                                <div class="card shadow-lg border-0" style="border-radius:10px;">
                                    <div class="card-body checkout-form">
                                        <div class="row">


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="first_name" required id="first_name"
                                                        value="{{ $userWithAddress->first_name }}" class="form-control"
                                                        placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="last_name"
                                                        value="{{ $userWithAddress->last_name }}" required id="last_name"
                                                        class="form-control" placeholder="Last Name">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="email"
                                                        value="{{ $userWithAddress->email }}" required id="email"
                                                        class="form-control" placeholder="Email">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <select name="country" required id="country" class="form-control">
                                                        <option value="">Select a Country ></option>
                                                        @foreach ($country as $key => $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}
                                                            </option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <textarea name="address" required id="address" value="" cols="30" rows="3"
                                                        placeholder="Address" class="form-control">{{ $userWithAddress->address }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" value="{{ $userWithAddress->apartment }}"
                                                        name="apartment" id="appartment" class="form-control"
                                                        placeholder="Apartment, suite, unit, etc. (optional)">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required value="{{ $userWithAddress->city }}"
                                                        name="city" id="city" class="form-control"
                                                        placeholder="City">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required value="{{ $userWithAddress->state }}"
                                                        name="state" id="state" class="form-control"
                                                        placeholder="State">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required value="{{ $userWithAddress->zip }}"
                                                        name="zip" id="zip" class="form-control"
                                                        placeholder="Zip">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" required value="{{ $userWithAddress->mobile }}"
                                                        name="mobile" id="mobile" class="form-control"
                                                        placeholder="Mobile No.">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <textarea name="notes" id="notes" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card shadow-lg border-0" style="border-radius:10px;">
                                    <div class="card-body checkout-form">
                                        <div class="row">


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="first_name" required id="first_name"
                                                        class="form-control" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="last_name" required id="last_name"
                                                        class="form-control" placeholder="Last Name">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="email" required id="email"
                                                        class="form-control" placeholder="Email">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <select name="country" required id="country" class="form-control">
                                                        <option value="">Select a Country</option>
                                                        @foreach ($country as $key => $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}
                                                            </option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <textarea name="address" required id="address" value="" cols="30" rows="3"
                                                        placeholder="Address" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" name="apartment" id="appartment"
                                                        class="form-control"
                                                        placeholder="Apartment, suite, unit, etc. (optional)">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required name="city" id="city"
                                                        class="form-control" placeholder="City">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required name="state" id="state"
                                                        class="form-control" placeholder="State">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <input type="text" required name="zip" id="zip"
                                                        class="form-control" placeholder="Zip">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input type="text" required name="mobile" id="mobile"
                                                        class="form-control" placeholder="Mobile No.">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <textarea name="notes" id="notes" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="col-md-4">
                            <div class="sub-title">
                                <h2 style="background-color: #f8ede8">Order Summery</h3>
                            </div>
                            <div class="card cart-summery" style="border-radius:10px">
                                <div class="card-body">
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    <div class="d-flex justify-content-between pb-2">

                                        <div class="h6">{{ $product->title }}</div>
                                        <div class="h6">${{ $product->price }} x {{ 1 }}</div>
                                        @php
                                            $subtotal += $product->price * 1;
                                        @endphp
                                    </div>

                                    <div class="d-flex justify-content-between summery-end">
                                        <div class="h6"><strong>Subtotal</strong></div>
                                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                        <div class="h6"><strong>${{ $subtotal }}</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="h6"><strong>Shipping</strong></div>
                                        <input type="hidden" name="shipping" value="20">
                                        <div class="h6"><strong>$20</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 summery-end">
                                        <div class="h5"><strong>Total</strong></div>
                                        <input type="hidden" name="grand_total" value="{{ $subtotal + 20 }}">
                                        <div class="h5"><strong>${{ $subtotal + 20 }}</strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card payment-form " style="border-radius:10px">
                                <h3 class="card-title h5 mb-3">Payment Method</h3>
                                <div class="">
                                    <input checked type="radio" name="payment_method" value="cod"
                                        id="payment_method_one">
                                    <label for="payment_method_one" class="form-check-label">COD</label>
                                </div>
                                <div class="">
                                    <input type="radio" name="payment_method" value="stripe" id="payment_method_two">
                                    <label for="payment_method_two" class="form-check-label">Stripe</label>
                                </div>


                                <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                                    <div class="mb-3">
                                        <label for="card_number" class="mb-2">Card Number</label>
                                        <input type="text" name="card_number" id="card_number"
                                            placeholder="Valid Card Number" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="expiry_date" class="mb-2">Expiry Date</label>
                                            <input type="text" name="expiry_date" id="expiry_date"
                                                placeholder="MM/YYYY" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="expiry_date" class="mb-2">CVV Code</label>
                                            <input type="text" name="expiry_date" id="expiry_date" placeholder="123"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <button style="border-radius:10px;" type="submit" name="submit"
                                        class="btn-dark btn btn-block w-100">Pay
                                        Now</button>
                                </div>
                            </div>


                            <!-- CREDIT CARD FORM ENDS HERE -->

                        </div>
                    </div>
                </form>
            @endif
        </div>
    </section>
@endsection
@section('customjs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#payment_method_one").click(function() {
                if ($(this).is(":checked")) {
                    $("#card-payment-form").addClass('d-none');
                }
            });

            $("#payment_method_two").click(function() {
                if ($(this).is(":checked")) {
                    $("#card-payment-form").removeClass('d-none');
                }
            });
        });
    </script>
@endsection
