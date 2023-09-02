@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3" style="background-color: #f8ede8">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
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
                </div>
                <div class="col-md-9">
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
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Orders No #</th>
                                            <th>Customer Name</th>
                                            <th>Mobile</th>
                                            <th>Status</th>
                                            <th>Total Ammount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($orders as $row)
                                            <tr>
                                                <td>
                                                    #OR{{ $row->id }}
                                                </td>
                                                <td>{{ $row->first_name }}</td>
                                                <td>
                                                    {{ $row->mobile }}
                                                </td>
                                                <td>
                                                    @if ($row->status === 'processing')
                                                        <span style="color: #3A3A6F;">Processing</span>
                                                    @elseif ($row->status === 'shipped')
                                                        <span style="color: blue;">Shipped</span>
                                                    @elseif ($row->status === 'delivered')
                                                        <span style="color: green;">Delivered</span>
                                                    @else
                                                        <span style="color: black;">Unknown</span>
                                                    @endif

                                                </td>
                                                <td>$ {{ $row->grand_total }}</td>
                                                <td>

                                                    @if ($row->status === 'processing')
                                                        <a href="{{ route('orders.cancel', ['id' => $row->id]) }}"
                                                            class="text-danger" style="color:white; ">Cancel Order</a>
                                                    @elseif($row->status === 'shipped')
                                                        <a href="{{ route('orders.cancel', ['id' => $row->id]) }}"
                                                            class="text-danger" style="color:white; ">Cancel Order</a>
                                                    @else
                                                        <p style="color:green">Delivered</p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
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
