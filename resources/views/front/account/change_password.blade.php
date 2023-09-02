@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 " style="background-color: #f8ede8">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>
    <div class="container">
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
    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('front.account.account_panel')
                </div>

                <div class="col-md-9" style="height:600px">
                    <div class="card" >
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Change Password</h2>

                        </div>

                        <div class="card-body p-4">
                            <form action="{{ route('front.password') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="name">Old Password</label>
                                        <input type="password" required name="old_password" id="old_password"
                                            placeholder="Old Password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name">New Password</label>
                                        <input type="password" required name="new_password" id="new_password"
                                            placeholder="New Password" class="form-control">
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <div class="mb-3">
                                        <label for="name">Confirm Password</label>
                                        <input type="password" required name="confirm_password" id="confirm_password"
                                            placeholder="Old Password" class="form-control">
                                    </div>
                                    <div class="d-flex">
                                        <button style="border-radius: 10px;" class="btn btn-dark mt-3" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>

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
