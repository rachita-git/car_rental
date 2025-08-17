<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
use App\Models\Car;

class AdminController extends Controller
{
    public function dashboard()
{
    $totalCustomers = Booking::distinct('phone')->count('phone');
    $availableCars = Car::where('status', 0)->count();
    $bookedCars = Car::where('status', 1)->count();

    return view('admin.dashboard', compact('totalCustomers', 'availableCars', 'bookedCars'));
}


    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('admin.auth.login');
    }

    public function login_auth(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|string|min:3|max:50',
                'password' => [
                    'required',
                    'string',
                    'min:8', // minimum length
                    'max:50',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
                ],
            ],
            [
                'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin = User::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::login($admin);
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
