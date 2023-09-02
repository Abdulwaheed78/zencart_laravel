@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6 text-right">
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <p> @include('admin.message')</p>

            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <form action="{{ route('orders.search') }} " method="get">

                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" name="search" value="{{ $search }}"
                                    class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Orders #</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Date Purchased</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#OR{{ $order->id }}</td>
                                    <td>{{ $order->first_name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->mobile }}</td>
                                    <td>
                                        @if ($order->status === 'delivered')
                                            <p>Status: Delivered</p>
                                        @else
                                            <form method="POST"
                                                action="{{ route('update-order-item-status', ['orderItemId' => $order->id]) }}">
                                                @csrf
                                                @method('POST')

                                                <div class="form-group">
                                                    <label for="status">Status:</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="processing"
                                                            {{ $order->status === 'processing' ? 'selected' : '' }}>
                                                            Processing</option>
                                                        <option value="shipped"
                                                            {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped
                                                        </option>
                                                        <option value="delivered"
                                                            {{ $order->status === 'delivered' ? 'selected' : '' }}>
                                                            Delivered</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update Status</button>
                                            </form>
                                        @endif



                                    </td>
                                    <td>{{ $order->grand_total }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-dark"
                                            data-order-id="{{ $order->id }}">View Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">

                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customjs')
@endsection
