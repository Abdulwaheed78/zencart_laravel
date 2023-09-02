@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 " style="background-color: #f8ede8">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.profile') }}">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('front.account.account_panel')
                    @if (session('success'))
                        <center>
                            <p class="text-success mt-3" id="error-message">
                                {{ session('success') }}
                            </p>
                        </center>
                    @elseif(session('error'))
                        <center>
                            <p class="text-danger mt-3" id="error-message">
                                {{ session('error') }}
                            </p>
                        </center>
                    @endif
                </div>
                <div class="col-md-9">

                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        placeholder="Enter Your Name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" value="{{ $user->email }}" name="email" id="email"
                                        placeholder="Enter Your Email" class="form-control">
                                </div>
                                @if(!@empty($user->customerAddresses[0]))

                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    @if (isset($user->customerAddresses[0]->mobile))
                                        <input type="text" name="mobile"
                                            value="{{ $user->customerAddresses[0]->mobile }}" id="phone"
                                            placeholder="Enter Your Phone" class="form-control">
                                    @else
                                        <input type="text" name="mobile" placeholder="Enter Your Phone"
                                            class="form-control">
                                    @endif

                                </div>

                                <div class="mb-3">
                                    <label for="phone">Address</label>
                                    @if (isset($user->customerAddresses[0]->address))
                                        <textarea name="address" id="address" class="form-control" cols="30" rows="5"
                                            placeholder="Enter Your Address">{{ $user->customerAddresses[0]->address }}</textarea>
                                    @else
                                        <textarea name="address" id="address" class="form-control" cols="30" rows="5"
                                            placeholder="Enter Your Address"></textarea>
                                    @endif
                                </div>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customjs')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Hide the error message after 2 seconds  for messages
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 3000);
    </script>
@endsection
