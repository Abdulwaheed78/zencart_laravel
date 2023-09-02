<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt</title>
    <style>
        /* Define CSS styles for your PDF here */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td,
        .table th {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <center><h1>Order Receipt</h1></center>
        <p>Date: {{ $order->created_at->format('l, F j, Y') }}</p>

        <!-- Order Items -->
        <div class="card">
            <div class="card-body">
                <h3>Order Items</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Product Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $detail)
                            <tr>
                                <td>{{ $detail->name }}</td>
                                <td>{{ $detail->qty }}</td>
                                <td>${{ $detail->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Subtotal</td>
                            <td>${{ $order->subtotal }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Shipping</td>
                            <td>$20.00</td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="2">TOTAL</td>
                            <td>${{ $order->grand_total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Payment Method and Billing Address -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="h4">Payment Method</h3>
                        <p>Cash On Delivery</p>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="h4">Billing Address</h3>
                        <address>
                            <strong>{{ $order->first_name }}</strong><br>
                            {{ $order->address }}<br>
                            {{ $order->city }} {{ $order->zip }}<br>
                            <abbr title="Phone">Phone:</abbr> {{ $order->mobile }}
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
