<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // signup
    function signup()
    {
        return view('admin.signup');
    }

    function store_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if ($request->password == $request->confirm_password) {
            $storeUser = new Users();
            $storeUser->name = $request->name;
            $storeUser->email = $request->email;
            $storeUser->password = md5($request->password);
            $storeUser->user_type = 'User';
            $storeUser->status = 1;
            $storeUser->save();
        }

        return redirect('signup')->with(['success' => 'Registered Successfully']);
    }

    // login
    function login()
    {
        return view('admin.login');
    }

    function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required', 'string', 'email', 'max:255', 'exists:users',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = md5($request->password);

        $data = Users::where('email', $email)->where('password', $password)->first();

        if ($data) {
            if (!Auth::check($request->email)) {
                $request->session()->put('id', $data->id);
                $request->session()->put('name', $data->name);
                $request->session()->put('user_type', $data->user_type);

                // return true;
                return redirect('/dashboard')->with('success', 'Login Successfully');
            }
        } else {
            return back()->with('password_check', '* Please enter the correct Password.');
        }
    }

    // logout
    function logout()
    {
        session()->flush();
        return redirect('/')->with('fail', 'Logout Successfully');
    }
}
