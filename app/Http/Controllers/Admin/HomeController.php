<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $tcategory=Category::count();
        $users=User::where('role',1)->count();
        $tproducts=Product::count();
        return view('admin.dashboard',compact('tcategory','users','tproducts'));

    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
