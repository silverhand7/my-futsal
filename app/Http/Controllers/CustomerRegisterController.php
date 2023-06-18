<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerRegisterController extends Controller
{
    public function form()
    {
        if (Auth::guard('customer')->check()) {
            return redirect('/');
        }
        return view('auth.customer-register');
    }

    public function action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|unique:customers',
        ]);

        $input = $request->toArray();
        $input['password'] = bcrypt($input['password']);

        $customer = Customer::create($input);

        Auth::guard('customer')->login($customer);

        return redirect('/')->with('success', 'Account registered successfully.');
    }
}
