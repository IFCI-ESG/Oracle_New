<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $otpFor;

    public function __construct($otp, $otpFor = 'Login')
    {
        $this->otp = $otp;
        $this->otpFor = $otpFor;
    }

    public function build()
    {
        return $this->subject('ESG-PRAKRIT Portal - OTP for ' . $this->otpFor)
                    ->view('emails.otp')
                    ->with([
                        'otp' => $this->otp,
                        'otpFor' => $this->otpFor
                    ]);
    }
}
