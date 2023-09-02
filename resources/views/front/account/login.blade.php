@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3" style="background-color: #f8ede8">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Login</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container" >

            <div class="login-form" style="height: 500px;">
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
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <h4 class="modal-title">Login to Your Account</h4>
                    <div class="form-group">
                        <input type="email" required class="form-control" name="email" placeholder="Email" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" required class="form-control" name="password" placeholder="Password" required="required">
                    </div>
                    <div class="form-group small">
                        <!-- Any additional form elements can be added here -->
                    </div>
                    <input type="submit" style="border-radius: 10px;" class="btn btn-dark btn-block btn-lg mt-3" value="Login">
                </form>
                <div class="text-center small mt-3">
                    Don't have an account? <a href="{{ route('auth.register') }}">Sign up</a>
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
