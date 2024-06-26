<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\SystemLog;
use App\Models\Business;
use Session;
use Mail;
use Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth/login-admin');
    }

    public function indexTest()
    {
        return view('auth/register-admin');
    }

    public function showMessage($status,$message,$route = NULL)
    {
        return array(
            'status' => $status,
            'message' => $message,
            'redirect' => $route,
        );
    }

    public function loginProcess(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'username' => 'required|regex:/^([A-za-z0-9]+)$/u',
            'password' => 'required',

        ],[
            'username.required' => 'The user name is required',
            'username.regex' => 'Login code does not allow special character',
            'password.required' => 'The password is required',
        ]);

        if($validator->fails()) {
            return $this->showMessage('fail',$validator->errors()->first());
        }

        $checkUser = User::where('login_code',$request->username)->first();
        if($checkUser == '')
        {
            return $this->showMessage('fail',trans('global.login.error.username'));
        }
        else
        {
            if($checkUser->login_code != $request->username)
            {
                return $this->showMessage('fail',trans('global.login.error.username'));
            }
            if(!Hash::check($request->password,$checkUser->user_password))
            {
                return $this->showMessage('fail',trans('global.login.error.password'));
            }
            else
            {
                $alpha   = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                $numeric = str_shuffle('0123456789');
                $code = substr($alpha, 0, 3) . substr($numeric, 0, 3);
                $otp = str_shuffle($code);
                date_default_timezone_set('America/New_York');
                $c_time =  date("Y-m-d H:i:s");
                $expireTime = date('Y-m-d H:i:s', strtotime($c_time . ' + 15 minutes'));
                $updateData = array(
                    'otp' => $otp,
                    'expire_otp_time' => $expireTime
                );
                User::whereId($checkUser->id)->update($updateData);
                $email = $checkUser->user_email;
                //send mail
                Mail::send(
                    'email.verifyOtp',
                    ['id' => $checkUser->id,'name' => $checkUser->user_name,'otp'=>$otp],
                    function ($mail) use ($email) {
                        $mail->from(env('mail_from_address'), env('MAIL_FROM_NAME'));
                        $mail->to($email);
                        $mail->subject('Cafe Bahagia Banget - One Time Password');
                    }
                );
                Session::put('login_code',$checkUser->login_code);
                if($request->remember == 'on')
                {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('username', $checkUser->login_code, $hour);
                    setcookie('password', $checkUser->plain_password, $hour);
                }
                else
                {
                    setcookie("username", "", time() - 3600);
                    setcookie("password", "", time() - 3600);
                }
                // $insertLogData = array(
                //     'business_id' => '',
                //     'menu_id' =>' ',
                //     'activity' => 'Login',
                //     'log_title' => 'Try to login in admin panel',
                //     'log_ip' => $_SERVER['REMOTE_ADDR'],
                //     'created_by' => Session::get('login_code')
                // );
                // SystemLog::insert($insertLogData);
                return $this->showMessage('successRedirect',trans('global.login.success.otpSend'),route('verifyOtp'));

            }
        }
    }

    public function verifyOtp()
    {
        if(Session::has('login_code'))
        {
            return view('auth.otp-admin');
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function verifyOtpProcess(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'otp' => 'required|size:6',
        ],[
            'otp.required' => trans('global.otpVerify.validation.otp'),
            'otp.size' => trans('global.otpVerify.validation.otpSize')
        ]);

        if($validator->fails()) {
            return $this->showMessage('fail',$validator->errors()->first());
        }

        $login_code = Session::get('login_code');
        $userData = User::where('login_code',$login_code)->first();

        if($userData->otp != $request->otp)
        {
            return $this->showMessage('fail',trans('global.otpVerify.error.otpWrong'));
        }
        elseif($userData->otp == $request->otp)
        {
            date_default_timezone_set('America/New_York');
            $c_time =  date("Y-m-d H:i:s");
            if($userData->expire_otp_time < $c_time)
            {
                Session::flush('login_code');
                return $this->showMessage('fail',trans('global.otpVerify.error.otpExpire'),route('login'));
            }
            else
            {
                // $insertLogData = array(
                //     'business_id' => '',
                //     'menu_id' =>' ',
                //     'activity' => 'Verify OTP',
                //     'log_title' => 'OTP Verify successfully',
                //     'log_ip' => $_SERVER['REMOTE_ADDR'],
                //     'created_by' => Session::get('login_code')
                // );
                // SystemLog::insert($insertLogData);
                // Session::put('name', $userData->user_data);
                Session::put('id', $userData->id);
                Session::put('name', $userData->login_code);
                return $this->showMessage('successRedirect',trans('global.otpVerify.success.loginSuccess'),route('dashboard',[Session::get('name')]));
            }
        }
    }

    public function logout()
    {
        Session::flush();
        // Notification Toastr
        $notification = array(
            'message' => 'Logout Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('login')->with($notification);
    }



}
