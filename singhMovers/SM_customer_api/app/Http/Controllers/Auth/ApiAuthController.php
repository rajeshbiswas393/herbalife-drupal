<?php

namespace App\Http\Controllers\Auth;
use PDO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Utils;
use App\Models\UserOTPVarification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ApiAuthController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|min:6',
            'type' => 'string|max:10',
        ]);

        
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $request['type'] = $request['type'] ? $request['type']  : 'Normal';
        $request['role'] = $request['role'] ? $request['role']  : 'All';
        $request['status'] = $request['status'] ? $request['status']  : 1;

         $user = User::create($request->toArray());
        $response = ['username' => $request['username'],'fullname' => $request['fullname'],'email' => $request['email'],'type' => $request['type'],
            'id' => $user->id];
        return response($response, 200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $response = ['email' => $request['email'],'username' => $user->username,'fullname' => $user->fullname,'id' => $user->id];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
    
     /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function sendOTP (Request $request) {
         $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255'
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if($user)
        {
            $otp =  random_int(100000, 999999);
            $OTPVarification = [
                    'user_id' => $user->id,
                    'otp'     => $otp,
                    'varification_done' => 0,
                    'datetime' => date('Y-m-d G:i:s')
                ];
            $userOTPVarification = UserOTPVarification::create($OTPVarification);
            $message = '<p> Your OTP for reset password is:<b>'.$otp.'</b></p>';
            $fromEmail = 'info@singhmovers.com.au';
            $fromName = 'Singh Movers';
            $toEmail = $user->email;
            $toName = $user->name;
            $subject = 'Reset Password OTP';
            
            Utils::sendEmail($toEmail,$fromEmail,$toName,$fromName,$subject, $message);
            $response = ['message' => 'OTP have been sent successfully!','user_id' => $user->id];
            return response($response, 200);
        }
        else
        {
             return response(['message'=>'No user found with this email'], 422);
        }
        
    }
    //Varify OTP
    
      public function varifyOTP (Request $request) {
         $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|max:255',
            'otp' => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $userOTPVarification = UserOTPVarification::where(['user_id' => $request->user_id,'varification_done' => 0])->first();
        if($userOTPVarification)
        {
            if($userOTPVarification->otp == $request->otp)
            {
                $userOTPVarification->update(['varification_done' => 1]);
                $response = ['message' => 'OTP Varified successfully!'];
                return response($response, 200);
            }
            else
            {
                $response = ['message' => 'Wrong OTP!'];
                return response($response, 422);
            }
            
        }
        else
        {
             return response(['message'=>'No user found with this email'], 422);
        }
        
    }
    
    
      public function changePassword (Request $request) {
         $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $userPasswordChnage = User::where(['id' => $request->user_id]);
        if($userPasswordChnage)
        {
                $userPasswordChnage->update(['password'=>Hash::make($request->password)]);
                $response = ['message' => 'Password changed successfully!'];
                return response($response, 200);
          
        }
        else
        {
             return response(['message'=>'No user found'], 422);
        }
        
    }
    
    public function userChangePassword (Request $request) {
         $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|max:255',
            'current_password' => 'required|string',
            'password' => 'required|string'
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $userPasswordChnage = User::where(['id' => $request->user_id])->first();
        if($userPasswordChnage)
        {
            if (Hash::check($request->current_password,$userPasswordChnage->password)) {
                 $userPasswordChnage->update(['password'=>Hash::make($request->password)]);
                $response = ['message' => 'Password changed successfully!'];
                return response($response, 200);
            }
            else
            {
                return response(['message'=>'Current password mismatched!'], 422);
            }
        }
        else
        {
             return response(['message'=>'No user found'], 422);
        }
        
    }
    
    
     public function editProfile (Request $request) {
         $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'fullname' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email|max:255',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $userEditProfile = User::where(['id' => $request->user_id]);
        if($userEditProfile)
        {
                $userEditProfile->update([
                    'fullname'=>$request->fullname,
                    'username'=>$request->username,
                    'email'=>$request->email]);
                $response = ['message' => 'User profile successfully!'];
                return response($response, 200);
          
        }
        else
        {
             return response(['message'=>'No user found'], 422);
        }
        
    }
}