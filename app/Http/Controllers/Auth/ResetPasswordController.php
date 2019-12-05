<?php

namespace Jaff\Http\Controllers\Auth;

use Jaff\User;
use Jaff\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function resetCode(Request $request,$phone){
     $user=User::where('phone',$phone)->first();
         // dd($user);
    return view('user.auth.reset')->with('user',$user);
    }

    public function verifyCode(Request $request,$phone){

    $enteredOtp = $request->input('otp');
        // $user=User::where('phone',$phone)->first();
    $exists=User::where('phone',$phone)->exists();
        
      if($exists){
        // dd($exists);
         $code=User::where('phone',$phone)->value('vcode');
              
          if($code===$enteredOtp){
            User::where('phone', $phone)->update(['phone_verified_at'=>date('Y-m-d H:i:s'),'vcode'=>null]);
            // dd($request->all());
            return redirect()->route('newPassword',['phone'=>$request->phone])->with('success','You are ready to give new Password');
            }
      }
    }


}
