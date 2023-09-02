<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;

class CartController extends Controller
{
    public function index()
    {

        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->get();
            $data['cart'] = $cart;
            return view('front.cart', $data);
        } else {
            return redirect()->route('login');
        }
    }






    public function store($id)
    {
        if (!Auth::check()) {
            // Redirect to login page
            return redirect()->route('login');
        }
        $user = Auth::user();
        // Retrieve the product along with its related images
        $product = Product::with('images')->findOrFail($id);
        $image = $product->images->first()->image;
        // Create a new instance of the product with initial quantity

        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->productid = $product->id;
        $cart->producttitle = $product->title;
        $cart->productprice = $product->price;
        $cart->productimage = $image;
        $cart->quantity = 1;
        $cart->save();
        // dd($image);

        return redirect()->route('front.cart');
    }
    public function destroy($id)
    {
        $data = Cart::findOrFail($id);

        $data->delete();
        return redirect()->route('front.cart')->with('error', 'data deleteed successfully');
    }

    public function updateQuantity(Request $request, $cartId)
    {
        $cartItem = Cart::findOrFail($cartId);

        if ($request->input('action') === 'increment') {
            $newQuantity = $cartItem->quantity + 1;
        } elseif ($request->input('action') === 'decrement' && $cartItem->quantity > 1) {
            $newQuantity = $cartItem->quantity - 1;
        } else {
            return redirect()->route('cart.show');
        }

        // Update the cart item's quantity
        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'newQuantity' => $cartItem->quantity,
        ]);
    }


    public function checkout()
    {
        $user = Auth::user();

        if (!$user) {
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('login');
        }
        session()->forget('url.intended');

        $cartCount = $user->cartItems->count();
        if ($cartCount === 0) {
            return redirect()->route('front.cart')->with('error', 'Add items to the cart to proceed');
        }

        $country = Country::orderBy('name', 'ASC')->get();

        $cart = Cart::where('user_id', $user->id)
            ->with('product') // Assuming you have a 'product' relationship in your Cart model
            ->get();

        // Retrieve user information and their address using a join
        $userWithAddress = User::select('users.*', 'customer_addresses.*')
            ->join('customer_addresses', 'users.id', '=', 'customer_addresses.user_id')
            ->where('users.id', $user->id)
            ->first();

        return view('front.checkout', compact('cart', 'country', 'userWithAddress'));
    }


    public function Order_store(Request $request)

    {

        $validatedData = $request->validate([
            'subtotal' => 'required',
            'grand_total' => 'required',
            'shipping' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|string',
            'country' => 'required|exists:countries,id', // Replace "countries" with your country table name
            'address' => 'required|string',
            'apartment' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'notes' => 'nullable|string',

        ]);
        $user = Auth::user();
        // Calculate order total based on your logic
        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            $addressData = [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]
        );

        $isComingFromCart = $request->query('from_cart') === 'true';

        // Calculate order total based on your logic
        if ($request->payment_method == 'cod') {
            // Get the authenticated user

            $order = new Order();
            $order->user_id = $user->id; // Associate the order with the authenticated user
            $order->subtotal =  $validatedData['subtotal'];
            $order->shipping =  $validatedData['shipping'];

            $order->grand_total =  $validatedData['grand_total'];
            $order->first_name = $validatedData['first_name'];
            $order->last_name = $validatedData['last_name'];
            $order->email = $validatedData['email'];
            $order->mobile = $validatedData['mobile'];
            $order->country_id = $validatedData['country'];
            $order->address = $validatedData['address'];
            $order->apartment = $validatedData['apartment'];
            $order->city = $validatedData['city'];
            $order->state = $validatedData['state'];
            $order->zip = $validatedData['zip'];
            $order->notes = $validatedData['notes'];
            $order->save();



            // Fetch cart items for the user
            $cartItems = Cart::where('user_id', $user->id)->get();

            // Loop through the cart items and create order items

        }
        if ($isComingFromCart) {
            foreach ($cartItems as $item) {
                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->productid;
                $orderItem->name = $item->producttitle;
                $orderItem->qty = $item->quantity;
                $orderItem->price = $item->productprice;
                $orderItem->total = $item->productprice * $item->quantity;
                $orderItem->save();
            }
            $delete = Cart::where('user_id', $user->id)->delete();
            //dd($delete);
            return redirect()->route('orders.thanks');
        } else {
            foreach ($cartItems as $item) {
                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->productid;
                $orderItem->name = $item->producttitle;
                $orderItem->qty = $item->quantity;
                $orderItem->price = $item->productprice;
                $orderItem->total = $item->productprice * $item->quantity;
                $orderItem->save();
            }
            // Redirect to a thank-you page or any other appropriate page
            return redirect()->route('orders.thanks');
        }
    }


    public function thanks()
    {
        return view('front.thanks');
    }





    public function checkout2(Request $request, $slug)
    {
        $user = Auth::user();

        if (!$user) {
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('login');
        }
        session()->forget('url.intended');

        $product = Product::where('slug', $slug)->with('images')->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found'); // Handle case when product is not found
        }

        $quantity = 1;

        $country = Country::orderBy('name', 'ASC')->get();

        $userWithAddress = User::select('users.*', 'customer_addresses.*')
            ->join('customer_addresses', 'users.id', '=', 'customer_addresses.user_id')
            ->where('users.id', $user->id)
            ->first();

        return view('front.checkout', compact('product', 'country', 'userWithAddress'));
    }
}
