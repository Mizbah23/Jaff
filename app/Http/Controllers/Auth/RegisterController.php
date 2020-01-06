<?php

namespace Jaff\Http\Controllers\Auth;

use Jaff\User;
use Jaff\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use Response;
use Auth;
use Redirect;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Jaff\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function showRegistrationForm ()
    {
         $data = array();
         $data['title'] = 'Sign Up';
         return view('user.auth.signup',$data);
    }
    
    
//    public function register(Request $request) 
//    {
//        $this->validator($request->all());
//        $user = new User;
//        $user->name = $request->name;
//        $user->phone = $request->phone;
//        $user->email = $request->email;
//        $user->password = Hash::make($request->password);
//        $user->sts = 0;
//        $user->save();
//
//        session()->flash('success', 'A verification code has been sent to '.$request->phone);
//        return Redirect::to('/login');
//
//    }
    
        public function register(Request $request) 
    {

         // dd($request->all());
               $this->validate($request,[
               'first_name'=>'required',
               'last_name'=>'required',
               'phone'=>'required | min:6|unique:users',
               'email'=>'required|unique:users',
               'password'=>'min:6|required_with:confirm_password|same:confirm_password',
               'confirm_password'=>'min:6'
        ]);

        // $this->validator($request->all());
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username=substr($request->first_name, 0, strrpos($request->first_name, ' '));;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // $user->status = 1;
        $user->vcode= Str::random(6);
        // dd($user);
        $user->save();
        
        

        $postUrl = "http://api.bulksms.icombd.com/api/v3/sendsms/xml";
        $smsbody = "Dear $user->username, Your OTP code is $user->vcode."
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
        // return URL::temporarySignedRoute(
        //     'otp', now()->addMinutes(2), ['phone'=>$request->phone]
        //   );
        return Redirect::to(URL::temporarySignedRoute('otp',now()->addMinutes(2),['phone'=>$user->phone])); 

    }
    
        public function getOTP(Request $request,$phone)
    {
        $data= array();
        $data['title']='OTP verification';
        $data['user']=User::where('phone',$phone)->first();
         // dd($user);
        return view('user.auth.otp',$data);
    }
          public function resendOTP(Request $request,$phone)
    {
        $data= array();
        $data['title']='OTP verification';
        $user=User::where('phone',$phone)->first();
         // dd($user);
        $postUrl = "http://api.bulksms.icombd.com/api/v3/sendsms/xml";
        $smsbody = "Dear $user->username, Your OTP code is $user->vcode"
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
           <gsm>88.$user->phone</gsm>
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
           $data['user']=$user;
           session()->flash('success', ' Code has been resent');
       return Redirect::to(URL::temporarySignedRoute('otp',now()->addMinutes(2),['phone'=>$data['user']->phone])); 
    }
    
        public function verifyOTP(Request $request,$phone){
        $enteredOtp = $request->input('otp');
        // $user=User::where('phone',$phone)->first();
        $exists=User::where('phone',$phone)->exists();
        
        if($exists){
            $code=User::where('phone',$phone)->value('vcode');
              
            if($code===$enteredOtp){
                User::where('phone', $phone)->update(['status' => 1,'phone_verified_at'=>date('Y-m-d H:i:s'),'vcode'=>null]);
                return redirect()->route('login')->with('success','You are ready to login');
            }
            else{
              return redirect()->back()->with('message','Wrong OTP!'); 
            }
        }
    }
    
        public function showNewForm(Request $request,$phone)
    {
          $data= array();
          $data['title']='New Password Form';
         $data['user']=User::where('phone',$phone)->first();
         
         return view('user.auth.newPassword',$data);
    }
    
        public function newLogin(Request $request,$phone)
                {
            $this->validate($request,[
               'password'=>'min:6|required_with:cpass|same:confirm_password',
               'confirm_password'=>'min:6'
        ]);

      $users=User::wherePhone($request->phone)->first();
      $users->password = Hash::make($request->password);
      // dd($users);
      $users->save();
      return redirect()->route('login')->with('success','Your Password has been Reset.Now you are ready to login!!!');
            }
}
