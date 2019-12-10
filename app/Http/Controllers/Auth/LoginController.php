<?php

namespace Jaff\Http\Controllers\Auth;

use Jaff\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Jaff\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showLoginForm()
    
    {
        $data = array();
        $data['title'] = 'Log In';
        return view('user.auth.login',$data);
        
    }
    
    public function __construct()
    {
        $this->middleware('guest:web',['except'=>['logout','userLogout']]);
    }
    
//    public function login(Request $request)
//    {
//        $this->validate($request,[
//            'phone' => 'required',
//            'password' => 'required|min:6'
//        ]);
//        if(Auth::guard('web')->attempt(['phone'=>$request->phone,'password'=>$request->password],$request->remember))
//        {
//            return redirect()->intended(route('home'));
//        }
//        return redirect()->back()->withInput($request->only('phone','remember'));
//    }
    
        public function login(Request $request)
    {
         // dd($request);
        $this->validate($request,[
            'phone' => 'required',
            'password' => 'required| min:2'
        ]);
        // dd($request);
        $user = User::where('phone', $request->phone)->first();
        // dd($user);
       if(!is_null($user))
       {   
           if(!Hash::check($request->password, $user->password))
           {
               // dd($user);
               session()->flash('errors', 'Your Password is wrong !!');
               return redirect()->route('login');
           }else{
               if ($user->status == 1)
               {
                   if(Auth::guard('web')->attempt
                           (['phone' => $request->phone, 'password' => $request->password], $request->remember))
                   {
                       // $request->session()->put('user',$user);
                       // dd($request->session());
                       return redirect()->route('home');
                   }
               }else{
                   // $user->notify(new VerifyRegistration($user));
                   // dd('not a user');
                   session()->flash('errors', 'You have not confirmed your verification.. Please check and confirm your phone');
                   return redirect()->route('login');
               }
           }
       }else{
           session()->flash('errors', 'Please Register first !!');
           return redirect()->route('login');
       }
    }
//    
//    public function login(Request $request)
//    {
//        $this->validate($request, [
//        'email' => 'required|email',
//        'password' => 'required',
//        ]);
//
//        $user = User::where('email', $request->email)->first();
//        if(!is_null($user))
//        {   
//            if(!Hash::check($request->password, $user->password))
//            {
//                session()->flash('errors', 'Your Password is wrong !!');
//                return redirect('/login');
//            }else{
//                if ($user->status == 1)
//                {
//                    if(Auth::guard('web')->attempt
//                            (['email' => $request->email, 'password' => $request->password], $request->remember))
//                    {
//                        return redirect()->intended(route('home'));
//                    }
//                }else{
//                    // $user->notify(new VerifyRegistration($user));
//                    
//                    session()->flash('errors', 'You have not confirmed your verification.. Please check and confirm your phone');
//                    return redirect('/login');
//                }
//            }
//        }else{
//            session()->flash('errors', 'Please Register first !!');
//            return redirect('/login');
//        }
//    }
    
    
    public function userLogout() 
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
    
}
