<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
class RegisterController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function store(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:250',
           'email' => 'required|email|max:250|unique:users',
           'password' => 'required|min:8|confirmed'
       ]);

       $user =  User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password)
       ]);

       UserAccess::create([
        'user_id' => $user->id,
        'role_id' => 1,
        ]);

       $credentials = $request->only('email', 'password');
       Auth::attempt($credentials);
       $request->session()->regenerate();

       return redirect()->route('dashboard')
           ->withSuccess('You have successfully registered & logged in!');
   }
}
