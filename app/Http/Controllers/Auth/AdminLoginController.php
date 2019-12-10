<?php

namespace Jaff\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Jaff\Http\Controllers\Controller;
use Auth;
use Jaff\Admin;
use Session;
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

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1],$request->remember))
        {
            $info = Admin::where('id',Auth::guard('admin')->user()->id)->first();
            if($info)
            {
                $menu_array = preg_split("/,/", $info->mper);
                foreach ($menu_array as $menu_per) 
                {
                    Session::put($menu_per,$menu_per);              
                }
                $work_array = preg_split("/,/", $info->wper);
                foreach ($work_array as $work_per) 
                {
                    Session::put($work_per,$work_per);              
                }
            }
            return redirect()->intended(route('admin.dashboard'));
           
        }
        session()->flash('error','Something went wrong!!!');
        return redirect()->back()->withInput($request->only('phone','remember'));
    }
    public function logout() 
    {
        Auth::guard('admin')->logout();
        session()->flush();
        session()->flash('message', 'successfully logged out');
        return redirect()->route('admin.login');
    }
}
