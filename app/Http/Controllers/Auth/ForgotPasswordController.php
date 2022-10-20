<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use SebastianBergmann\Environment\Console;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function sendResetLinkEmail(Request $request)
    {

        $email = $request->input('email');

        if(isset($email)){
            $subject = "Forgot password";
         
            $temp_password = $this->randomPassword();
           
           try
            {
                $ch_pass = User::where('email', $email)->firstOrFail();

                $ch_pass->password = Hash::make($temp_password);
                $ch_pass->save();
   
                Mail::to($email)->queue(new Mailer($subject,$email,$temp_password));
   
                return back()->with('message', 'Send email already!');
   
            }
            catch (ModelNotFoundException $e)
            {
                return redirect()->back()->withErrors('We can’t find a user with that e-mail address.');
            }
   

        }else{
            return redirect()->back()->withErrors('The email field is required.');
        }

    }
}
