@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3" style="background-color: #f8ede8">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{route('front.home')}}">Home</a></li>
                <li class="breadcrumb-item">Register</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-10">
    <div class="container">
        <div class="login-form" style="height: 600px;">
            <form action="{{route('auth.register')}}" method="post">
                @csrf
                <h4 class="modal-title">Register Now</h4>
                <div class="form-group">
                    <input type="text" required class="form-control" placeholder="Name" id="name" name="name">
                </div>
                <div class="form-group">
                    <input type="text"required class="form-control" placeholder="Email" id="email" name="email">
                </div>

                <div class="form-group">
                    <input type="text"required class="form-control" placeholder="Password" id="password" name="password">
                </div>
                <div class="form-group">
                    <input type="password"required class="form-control" placeholder="Confirm Password" id="cpassword" name="cpassword">
                </div>
                <div class="form-group small">

                </div>
                <button type="submit" style="border-radius:10px" class="btn btn-dark btn-block btn-lg mt-3" value="Register">Register</button>
            </form>
            <div class="text-center small">Already have an account? <a href="{{route('login')}}">Login Now</a></div>
        </div>
    </div>
</section>
@endsection
@section('customjs')
@endsection
