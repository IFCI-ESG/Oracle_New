<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
<<<<<<< HEAD
=======
use Illuminate\Contracts\Queue\ShouldQueue;
>>>>>>> 7531f0f92209ebd3621ce86b1b6bc8b03947fc36
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

<<<<<<< HEAD
    public $otp;
    public $otpFor;

    public function __construct($otp, $otpFor = 'Login')
    {
        $this->otp = $otp;
        $this->otpFor = $otpFor;
=======
    public $msg;

    public function __construct($msg)
    {
        $this->msg = $msg;
>>>>>>> 7531f0f92209ebd3621ce86b1b6bc8b03947fc36
    }

    public function build()
    {
<<<<<<< HEAD
        return $this->subject('ESG-PRAKRIT Portal - OTP for ' . $this->otpFor)
                    ->view('emails.otp')
                    ->with([
                        'otp' => $this->otp,
                        'otpFor' => $this->otpFor
                    ]);
=======
        return $this->subject('ESG PRAKRIT - One Time Passowrd(OTP)')->view('emails.otpmail',['msg'=> $this->msg]);
>>>>>>> 7531f0f92209ebd3621ce86b1b6bc8b03947fc36
    }
}
