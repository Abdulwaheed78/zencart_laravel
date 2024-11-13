<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

class LoginAdminController extends Controller
{
    //

    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {

        $validator = validator::make($request->all(), [
            'email' => "required|email",
            'password' => 'required'
        ]);

        if ($validator->passes()) {

            if (Auth::guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $request->get('remember'))) {
                $admin = Auth::guard('admin')->user();
                if ($admin->role == 2) {
                    return redirect()->route('admin.dashboard')->with('admin', $admin);
                } else {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'You are not authorized to access admin panel');
                }
            } else {
                return redirect()->route('admin.login')->with('error', 'Either email or password is incorrect ');
            }
        } else {
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }


    public function showChangePasswordForm()
    {
        return view('admin.layouts.password');
    }


    // ...

    public function changePassword(Request $request)
    {
        $validator = validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->passes()) {
            $user = Auth::guard('admin')->user();

            if (Hash::check($request->current_password, $user->password)) {
                // The current password matches, proceed to change the password
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);

                return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully');
            } else {
                return redirect()->route('admin.changePassword')->with('error', 'Current password is incorrect');
            }
        } else {
            return redirect()->route('admin.changePassword')->withErrors($validator);
        }
    }
}
