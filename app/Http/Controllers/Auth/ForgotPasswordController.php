<?php

namespace Jaff\Http\Controllers\Auth;

use Jaff\Notifications\SendMail;
use Jaff\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Response;
use Redirect;
use Auth;
use Jaff\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function forgotPassword()
    {
      $data = array();
      $data['title'] = 'varification Code'; 
      return view('user.auth.forgetPassword',$data);
    }
    
    public function postForgotPassword(Request $request)
    {

       $user=User::wherePhone($request->phone)->first();
       
       if($user!=null){
        $user->vcode= Str::random(6);
        $user->save();
        $user->notify(new SendMail($user));
        $postUrl = "http://api.bulksms.icombd.com/api/v3/sendsms/xml";
        
        $smsbody = "Dear $user->username, your password varification code is $user->vcode."
                 . " For any query call us 0011223344.  Regards, Jaff.";

         $xmlString =
           "
           <SMS>
           <authentification>
           <username>jakia</username>
           <password>Jakiasms786</password>
           </authentification>
           <message>
           <sender>jakia</sender>
           <text>$smsbody</text>
           </message>
           <recipients>
           <gsm>88.$request->phone</gsm>
           </recipients>
           </SMS>
           ";
           $fields = "XML=" . urlencode($xmlString);
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $postUrl);
           curl_setopt($ch, CURLOPT_POST, 1);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
           curl_exec($ch);
           curl_close($ch);
           session()->flash('success', 'A verification code has been sent to '.$request->phone);
           return Redirect::to(URL::temporarySignedRoute('reset',now()->addMinutes(2),
            ['phone'=>$request->phone])); 
         } else {
            return redirect()->back()->with('message','This user may not exist!');    
         }

//         
   }
}
