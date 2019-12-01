<?php

namespace Jaff\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Jaff\Http\Controllers\Controller;
use Auth;
class AdminLoginController extends Controller
{
    
    public function __construct() 
    {
        $this->middleware('guest:admin',['except'=>['logout']]);
    }
    public function showLoginForm()
    {
        return view('auth.admin_login');
        
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1],$request->remember)){
          
            return redirect()->intended(route('admin.dashboard'));
           
        }
        session()->flash('error','Something went wrong!!!');
        return redirect()->back()->withInput($request->only('phone','remember'));
    }
    public function logout() 
    {
        Auth::guard('admin')->logout();
        session()->flash('message', 'successfully logged out');
        return redirect()->route('admin.login');
    }
}
