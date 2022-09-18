<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use SebastianBergmann\Environment\Console;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Hash;

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
        //echo $email;
        $to = "gkwon8891@gmail.com";
         $subject = "Test send mail";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:mailto:car.mnm01@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

         $temp_password = $this->randomPassword();
         $aaa = env("MAIL_USERNAME");

         $ch_pass = User::where('email', $email)->firstOrFail();
         if($ch_pass) {
             $ch_pass->password = Hash::make($temp_password);
             $ch_pass->save();
         }
         $body = view('admin.template_email.forgotpassword', compact('email', 'temp_password'))->render();
         echo $body;
         exit;
        //  $retval = Mail ($to,$subject,$message,$header);
         
        //  if( $retval == true ) {
        //     echo "Message sent successfully...";
        //  }else {
        //     echo "Message could not be sent...";
        //  }
    }
}
