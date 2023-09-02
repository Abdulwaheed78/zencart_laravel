<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class FrontController extends Controller
{
    public function index()
    {

        $products = Product::where('is_featured', 'Yes')->where('status', 1)->take(20)->get();
        $latest = Product::orderBy('id', 'desc')->where('status', 1)->take(20)->get();
        $data['featuredproducts'] = $products;
        $data['latest'] = $latest;
        return view('front.home', $data);
    }


    public function updatepass(Request $request)
    {
        $user = User::find($request->user_id);
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Old password does not match');
        }

        $newPassword = Hash::make($request->password);
        $user->password = $newPassword;
        $user->save();
        return redirect()->route('front.password')->with('success', 'Password Updated Successfully');
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->with('images')->first();
        if ($product == null) {
            abort(404);
        }


        // Get the category and subcategory IDs of the current product
        $categoryId = $product->category_id;
        $subcategoryId = $product->sub_category_id;

        // Get related products from the same category and subcategory
        $relatedProducts = Product::where('category_id', $categoryId)
            ->where('sub_category_id', $subcategoryId)
            ->where('id', '<>', $product->id)
            ->with('images') // Exclude the current product
            ->get();

        $data['relatedProducts'] = $relatedProducts;
        $data['product'] = $product;
        return view('front.product', $data);
    }
    public function about()
    {
        return view('front.about');
    }


    public function contact()
    {
        return view('front.contact');
    }

    public function account()
    {
        $users = Auth::user();
        $user = User::with('customerAddresses')->find($users->id);

        //dd($user);
        return view('front.account.account', compact('user'));
    }


    public function orders()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $orders = Order::where('user_id', $user->id)->get();
            return view('front.account.my_orders', compact('orders'));
        } else {
            return redirect()->route('login');
        }
    }



    public function cancelOrder($id)
    {
        $user = Auth::user();

        // Retrieve and delete the order if it belongs to the authenticated user
        $order = Order::where('user_id', $user->id)
            ->where('id', $id)
            ->where('status', 'processing') // You can add more criteria here
            ->first();

        if ($order) {
            $order->delete();
            return redirect()->route('front.orders')->with('success', 'Order canceled successfully.');
        }

        return redirect()->route('front.orders')->with('error', 'Failed to cancel order.');
    }





    public function wishlist()
    {
        return view('front.account.wishlist');
    }
    public function password()
    {

        return view('front.account.change_password');
    }



    public function Register()
    {
        return view('front.account.register');
    }

    public function login()
    {
        return view('front.account.login');
    }

    public function store(Request $request)
    {
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 1, // Set the role to 1
        ]);

        $user->save();

        return redirect()->route('login')->with('success', 'signup successfully now login in your account'); // Redirect to user listing
    }


    public function logincheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'role' => 1 // Check for role 1
            ], $request->get('remember'))) {
                $user = Auth::user();
                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'));
                };
                $user = User::find($user->id);
                return redirect()->route('front.profile', compact('user'))->with('success', 'Login successful');
            } else {
                return redirect()->back()->with('error', 'Invalid credentials or not authorized');
            }
        } else {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'logout successful ');
    }
    public function getpage($slug)
    {
        $category1 = Category::where('slug',$slug)->get();
        $category=$category1[0]->id;
        //dd($category);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
$products=Product::where('category_id',$category)->get();
$subcategory=SubCategories::where('category_id',$category)->get();


        return view('front.testshop',compact('products','category1','subcategory'));
    }
}
