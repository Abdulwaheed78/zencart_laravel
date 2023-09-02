@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="container">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #{{ $order->id }}</h2>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('order.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>

            <!-- Main content -->

            <div class="col-lg-8">
                <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <span class="me-3">{{ $order->created_at->format('l, F j, Y') }}</span>
                                <span class="me-3">#{{ $order->id }}</span>
                                <span class="me-3">Cash On Delivery</span>
                                <span class="badge rounded-pill bg-info">{{ $order->status }}</span>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('orders.printReceipt', $order->id) }}" class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text">
                                    <i class="bi bi-download"></i> <span class="text">Print Receipt</span>
                                </a>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                <tr style="border:1px solid black; border-radiues:10px">
                                    <td>
                                        <div class="d-flex mb-2">

                                            <div class="flex-lg-grow-1 ms-3">
                                                <h6 class="small mb-0"><a href="#"
                                                        class="text-reset">Product Name</a></h6>

                                            </div>
                                        </div>
                                    </td>
                                    <td>Quantity</td>
                                    <td class="text-end">Product Price</td>
                                </tr>
                                </tr>
                                @foreach ($order->orderItems as $key => $detail)
                                    <tr style="border:1px solid black; border-radiues:10px">
                                        <td>
                                            <div class="d-flex mb-2">

                                                <div class="flex-lg-grow-1 ms-3">
                                                    <h6 class="small mb-0"><a href="#"
                                                            class="text-reset">{{ $detail->name }}</a></h6>

                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $detail->qty }}</td>
                                        <td class="text-end">${{ $detail->price }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Subtotal</td>
                                    <td class="text-end">${{ $order->subtotal }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Shipping</td>
                                    <td class="text-end">$20.00</td>
                                </tr>

                                <tr class="fw-bold">
                                    <td colspan="2">TOTAL</td>
                                    <td class="text-end">${{ $order->grand_total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- Payment -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="h4">Payment Method</h3>
                                <p>Cash On Delivery</p>

                            </div>
                            <div class="col-lg-6">
                                <h3 class="h4">Billing address</h3>
                                <address>
                                    <strong>{{ $order->first_name }}</strong><br>
                                    {{ $order->address }}<br>
                                    {{ $order->city }} {{ $order->zip }}<br>
                                    <abbr title="Phone">Phone:</abbr>{{ $order->mobile }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection




@section('customjs')
@endsection
