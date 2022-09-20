<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $email;
    public $temp_password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$email,$temp_password)
    {
        $this->subject = $subject;
        $this->email = $email;
        $this->temp_password = $temp_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->email;
        $temp_password = $this->temp_password;
        
        return $this->subject($this->subject)->view('admin.template_email.forgotpassword', compact('email', 'temp_password'));
    }
}