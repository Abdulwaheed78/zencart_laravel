<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $search = null;
        return view('admin.orders.index', compact('orders', 'search'));
    }


    public function search(Request $request)
    {

        //dd($request->search);
        $search = $request->search;
        $orders = Order::query()
            ->where('first_name', 'LIKE', "%{$search}%")
            ->get();


        //dd($data);
        return view('admin.orders.index', compact('orders', 'search'));
    }

    public function show($id)
    {
        // Load the order details and ordered items
        $order = Order::with('orderItems.product')->find($id);
        // Return a view with the order details
        return view('admin.orders.details', compact('order'));
    }




    // ...



    public function generatePDF($orderId)
    {
        $order = Order::with('orderItems.product')->find($orderId);
        if (!$order) {
            abort(404, 'Order not found');
        }

        $pdf = PDF::loadView('admin.orders.pdf', compact('order'));

        return $pdf->download('order_receipt.pdf');
    }



    public function updateOrderItemStatus(Request $request, $orderItemId)
    {
        // Validate the request if necessary

        $status = $request->input('status');

        // Update the order item status in the orders table
        Order::where('id', $orderItemId)->update(['status' => $status]);

        // Redirect back or to a different page
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }


}
