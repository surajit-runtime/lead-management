<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

// use Mail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;
use Carbon\carbon;
use App\Rules\CapchaRule;

class LoginController extends Controller
{
    //
    public function index()
    {
        if (!Session::has('userdata')) {
            return view('frontend.login');
        } else {
            if (Session::has('userdata')) {
                $data = Session::get('userdata');

                if ($data->role_id === 1 || $data->role_id === 2) {
                    return redirect()->route('dashboard');
                } elseif ($data->role_id === 3) {
                    return redirect()->route('Zonedashboard');
                } elseif ($data->role_id === 5) {
                    return redirect()->route('dashboard');
                } else {
                    Session::flush();
                    Session::forget('userdata');
                    return redirect()->back()->with('error', 'Unauthourized Access');
                }
            } else {
                return view('frontend.login');
            }
        }
    }
    public function resetPassPage()
    {
        return view('frontend.auth-recoverpw');
    }
    public function checklogin(Request $request)
    {
        if (Session::get('userdata')) {
            $data = Session::get('userdata');
            if ($data->role_id === 1 || $data->role_id === 2) {
                return redirect()->route('dashboard')->with('warning', $data->email . ' already Logged In');
            } elseif ($data->role_id === 3) {
                return redirect()->route('Zonedashboard')->with('warning', $data->email . ' already Logged In');
            } elseif ($data->role_id === 5) {
                return redirect()->route('dashboard')->with('warning', $data->email . ' already Logged In');
            } else {
                Session::flush();
                Session::forget('userdata');
                return redirect()->back()->with('error', 'Unauthorized Access');
            }
        } else {
            $request->validate([
                'username' => 'required|email',
                'password' => 'required',
                'captcha' => 'required'
            ]);
            $fdata = $request->input();
            $data = DB::table('tbl_users')->select('*')->where('email', $fdata['username'])->first();
            if ($data) {
                if ($data->is_login == 1) {
                    return redirect()->back()->with('error', 'User already Logged In.');
                }
                $otpCacheKey = 'otp_attempts_' . $data->id;
                $otpAttempts = Cache::get($otpCacheKey, 0);
                if ($otpAttempts >= 5) {
                    return redirect()->back()->with('error', 'Maximum OTP attempts exceeded. Please try again later.');
                }
                if ($data->login_enable == 1 && $data->status == 1) {
                    if (password_verify($fdata['password'], $data->password)) {
                        if (!CapchaRule::validateCaptcha($fdata['captcha'])) {
                            return redirect()->back()->with(['error' => 'Invalid captcha. Please try again.']);
                        }

                        Session::put('lastActivityTime', now());
                        $count = $data->login_count + 1;
                        $updt_user_count = DB::table('tbl_users')->where('id', $data->id)->update(['login_count' => $count]);
                        if ($request->has('rememberme')) {
                            Cache::put('userdata', $data, 600);
                            Cache::put('email', $data->email, 600);
                            Cache::put('password', $fdata['password'], 600);
                            $request->session()->put('remember_me', true);
                        }
                        Session::put('email', $data->email);
                        $otp = rand('100000', '999999');
                        $this->otpsendmailLogin($data->first_name, $data->email, $otp);
                        Cache::put($otpCacheKey, $otpAttempts + 1, now()->addMinutes(30));
                        $updt_user = DB::table('tbl_users')->where('email', $fdata['username'])->update(['otp' => $otp]);
                        return redirect()->back()->with('OTPlogin', 'OTP send Successfully.');
                    } else {
                        $this->insertLog1($description = 'Username or Password does not match.', $status = 'failed', $ip_address1 = NULL);
                        // if ($data->pass_wrong_count == 0) {
                        //     DB::table('tbl_users')->where('id', $data->id)->update(['pass_wrong_count' => 1]);
                        // } else {
                        //     DB::table('tbl_users')->where('id', $data->id)->update(['pass_wrong_count' => $data->pass_wrong_count + 1]);
                        // }
                        return redirect()->back()->with('error', 'Username or Password does not match.');
                    }
                } else {
                    return redirect()->back()->with('error', 'User is not enabled. Kindly contact with the Admin');
                }
            } else {
                $this->insertLog1($description = 'login attempted', $status = 'failed', $ip_address1 = NULL);
                return redirect()->back()->with('error', 'User not found.');
            }
        }
    }

    public function reloadCaptcha()
    {
        $configCaptchaType = config('captcha.CAPTCHA_TYPE');

        // Initialize variable to store captcha type
        $captchaType = '';

        // If the config number is 0, set captcha type to 'flat' (alphanumeric)
        // If it's 1, set captcha type to 'math'
        if ($configCaptchaType == 0) {
            $captchaType = 'alphanumeric';
        } else {
            $captchaType = 'math';
        }

        // the generated type will be stored in the captchaImage
        $captchaImage = captcha_img($captchaType);

        // Return JSON response with the generated captcha image
        return response()->json(['captcha' => $captchaImage]);
    }

    public static function generateCaptcha()
    {
        $configCaptchaType = config('captcha.CAPTCHA_TYPE');

        // If the config number is 0, generate a 'flat' (alphanumeric) captcha,
        // otherwise, generate a 'math' captcha
        if ($configCaptchaType == 0) {
            return captcha_img('alphanumeric');
        } else {
            return captcha_img('math');
        }
    }
    public function generateOTP(Request $request)
    {
        $request->validate([
            'username' => 'required|email'

        ]);
        $fdata = $request->input();
        $user = DB::table('tbl_users')->select('*')->where('email', $fdata['username'])->first();
        if ($user->login_enable == 1 && $user->status == 1) {
            if ($user) {
                $otpCacheKey = 'otp_attempts_' . $user->id;
                $otpAttempts = Cache::get($otpCacheKey, 0);
                if ($otpAttempts >= 5) {
                    return redirect()->back()->with('error', 'Maximum OTP attempts exceeded. Please try again later.');
                }
                $otp = rand('100000', '999999');
                Session::put('email', $user->email);
                $this->otpsendmail($user->first_name, $user->email, $otp);
                Cache::put($otpCacheKey, $otpAttempts + 1, now()->addMinutes(30));
                $updt_user = DB::table('tbl_users')->where('email', $fdata['username'])->update(['otp' => $otp]);
                $this->insertLog1($description = 'OTP sent', $status = 'successfull', $ip_address1 = NULL);
                return redirect()->route('reset_pass')->with('sendotpsuccess', 'OTP sent successfully');
                //echo "hi";
                //return redirect()->back()->with('sendotpsuccess', 'OTP sent successfully');

            } else {
                $this->insertLog1($description = 'OTP sent and User not found', $status = 'unsuccessfull', $ip_address1 = NULL);
                return redirect()->back()->with('error', 'User not found.');
            }
        } else {
            return redirect()->back()->with('error', 'User is not enabled.');
        }

    }


    public function otpsendmail($name, $email, $otp)
    {
        $data = ['name' => $name, 'otp' => $otp];
        $user['to'] = $email;
        $user['from'] = env('MAIL_FROM_ADDRESS');
        Mail::send('otpemail', $data, function ($messages) use ($user) {
            $messages->from($user['from']);
            $messages->to($user['to']);
            $messages->subject('OTP to reset password');
        });
    }
    public function otpsendmailLogin($name, $email, $otp)
    {
        $data = ['name' => $name, 'otp' => $otp];
        $user['to'] = $email;
        $user['from'] = env('MAIL_FROM_ADDRESS');
        Mail::send('otpemailLogin', $data, function ($messages) use ($user) {
            $messages->from($user['from']);
            $messages->to($user['to']);
            $messages->subject('OTP to login');
        });
    }
    public function otpverify(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'hidden_email' => 'required'
        ]);

        $fdata = $request->input();
        $otpcheck = DB::table('tbl_users')->select('*')->where('email', $fdata['hidden_email'])->first();
        if ($otpcheck) {
            if ($otpcheck->otp == $fdata['otp']) {
                $updt_otp = DB::table('tbl_users')->where('email', $fdata['hidden_email'])->update(['otp' => '1']);
                $this->insertLog1($description = 'OTP verified.', $status = 'successful', $ip_address1 = NULL);
                return redirect()->route('reset_pass')->with('successotp', 'OTP verified.');

            } else {
                $this->insertLog1($description = 'OTP verified.', $status = 'unsuccessful', $ip_address1 = NULL);
                return redirect()->back()->with('error', 'OTP does not match.');
            }

        }

    }
    public function loginOtpVerfiy(Request $request)
    {
        // $fdata = $request->input();
        // print_r($fdata);
        // die();
        $request->validate([
            'otp' => 'required',
            'hidden_email' => 'required'
        ]);

        $fdata = $request->input();

        $otpcheck = DB::table('tbl_users')->select('*')->where('email', $fdata['hidden_email'])->first();
        if ($otpcheck) {
            if ($otpcheck->otp == $fdata['otp']) {
                $request->session()->put('userdata', $otpcheck);
                $updt_otp = DB::table('tbl_users')->where('email', $fdata['hidden_email'])->update(['otp' => '1', 'is_login' => 1]);
                $this->insertLog1($description = 'OTP verified.', $status = 'successful', $ip_address1 = NULL);
                // return redirect()->route('reset_pass')->with('successotp', 'OTP verified.');
                $ip_address = session()->get('ip_address', $this->getIp()); // Use get() instead of put() to retrieve the value

                $this->insertLog($description = 'Logined', $status = 'successful');

                if ($otpcheck->role_id === 1 || $otpcheck->role_id === 2) {
                    $this->insertLog($description = 'redirected to dashboard for role ' . $otpcheck->role_id, $status = 'successful');
                    return redirect()->route('dashboard');
                } elseif ($otpcheck->role_id === 3) {
                    $this->insertLog($description = 'redirected to call center dashboard for role ' . $otpcheck->role_id, $status = 'successful');
                    return redirect()->route('Zonedashboard');
                } elseif ($otpcheck->role_id === 5) {
                    $this->insertLog($description = 'redirected to master dashboard for role ' . $otpcheck->role_id, $status = 'successful');
                    return redirect()->route('dashboard');
                } else {
                    Session::flush();
                    Session::forget('userdata');
                    return redirect()->back()->with('error', 'Unauthourized Access');
                }

            } else {
                $this->insertLog1($description = 'OTP verified.', $status = 'unsuccessful', $ip_address1 = NULL);
                return redirect()->back()->with('error', 'OTP does not match.');
            }

        }


    }
    //     public function updatpass(Request $request)
    // {
    //     // $request->validate([
    //     //     'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]{8,}$/',
    //     //     'cpassword'=>'required',
    //     //     'hidden_email'=> 'required'
    //     // ]);
    //     $request->validate([
    //         'password' => [
    //             'required',
    //             'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]{8,}$/'
    //         ],
    //         'cpassword' => 'required|same:password',
    //         'hidden_email' => 'required|email'
    //     ], [
    //         'password.regex' => 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.',
    //         'cpassword.same' => 'Passwords do not match.'
    //     ]);


    //     $fdata = $request->input();
    //     $checkuser = DB::table('tbl_users')->select('*')->where('email', $fdata['hidden_email'])->first();
    //     if ($checkuser) {
    //         if ($fdata['password'] === $fdata['cpassword']) {
    //             $updt_pass = DB::table('tbl_users')->where('email', $fdata['hidden_email'])->update(['password' => Hash::make($fdata['password'])]);
    //             $this->insertLog1($description = 'Password changed', $status = 'successful', $ip_address1 = NULL);
    //             return redirect()->route('index')->with('successChangepass', 'Password changed succesfully.');


    //         } else {
    //             $this->insertLog1($description = 'Password changed', $status = 'unsuccessful', $ip_address1 = NULL);
    //             return redirect()->back()->with('error', 'Password does not match.');
    //         }

    //     }
    // }

    // ! surajit code
    public function updatpass(Request $request)
{
    // Validate the request data
    $request->validate([
        'password' => [
            'required',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]{8,}$/'
        ],
        'cpassword' => 'required|same:password',
        'hidden_email' => 'required|email|exists:tbl_users,email'
    ], [
        'password.required' => 'Password is required.',
        'password.regex' => 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        'cpassword.required' => 'Confirm Password is required.',
        'cpassword.same' => 'Passwords do not match.',
        'hidden_email.required' => 'Email is required.',
        'hidden_email.email' => 'Invalid email format.',
        'hidden_email.exists' => 'User not found with this email.'
    ]);

    // Retrieve input data from the request
    $fdata = $request->input();

    // Retrieve user data from the database based on email
    $checkuser = DB::table('tbl_users')->select('*')->where('email', $fdata['hidden_email'])->first();

    // Check if user exists in the database
    if ($checkuser) {
        // Check if passwords match
        if ($fdata['password'] === $fdata['cpassword']) {
            // Attempt to update the user's password in the database
            try {
                $updt_pass = DB::table('tbl_users')->where('email', $fdata['hidden_email'])->update(['password' => Hash::make($fdata['password'])]);
            } catch (\Exception $e) {
                // Log the database update error
                $this->insertLog1('Failed to update password in DB', 'error', null);
                return redirect()->back()->with('error', 'Failed to update password in database. Please try again.');
            }

            // Check if password update was successful
            if ($updt_pass) {
                // Log the successful password change action
                $this->insertLog1('Password changed', 'successful', null);
                return redirect()->route('index')->with('successChangepass', 'Password changed successfully.');
            } else {
                // Log the unsuccessful attempt to update password
                $this->insertLog1('Password changed', 'unsuccessful', null);
                return redirect()->back()->with('error', 'Failed to update password. Please try again.');
            }
        } else {
            // Log the unsuccessful attempt due to passwords not matching
            $this->insertLog1('Password changed', 'unsuccessful', null);
            return redirect()->back()->with('error', 'Passwords do not match.');
        }
    } else {
        // Log the unsuccessful attempt due to user not found
        $this->insertLog1('Password changed', 'unsuccessful', null);
        return redirect()->back()->with('error', 'User not found with this email.');
    }
}


    public function logout()
    {
        if (Session::has('userdata')) {
            // Check if "Remember Me" was checked during login
            if (!Session::has('remember_me')) {
                Cache::forget('userdata');
                Cache::forget('email');
                Cache::forget('password');
            }
            $this->insertLog($description = 'Log-out', $status = 'successful');
            $updt_isLogin = DB::table('tbl_users')->where('id', Session::get('userdata')->id)->update(['is_login' => 0]);
            // Remove specific keys from the session
            Session::forget(['userdata', 'remember_me']);

            // Flush all session data
            Session::flush();
        }

        return redirect()->route('index');
    }



}
