<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function showLoginForm()
    {
       
        if (Auth::check()) {
            return redirect()->route('admin-login');
        }


        return view('dashboard.login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/admin'); // Redirect to the intended page or a default
        }
        // Authentication failed
        return back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }

    // Handle the logout request
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin-login');
    }
}
