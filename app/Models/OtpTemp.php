<?php
namespace App\Models;

class OtpTemp
{

    function __construct()
    { }

    private $API_KEY = '6799cc636677c';
    private $SENDER_ID = "ESGPRA";
    // private $ROUTE_NO = 4;
    private $RESPONSE_TYPE = 'json';
	// private $DLT_TE_ID = 1207161770681245489;


    public function sendSMS($mobileNumber, $module, $otp)
    {
        // dd($mobileNumber, $module,$otp);
        $isError = 0;
        $errorMessage = true;

            // dd('cre');"
        $message =   $otp." is your one time password (OTP) ".$module." to ESG Prakrit. Please enter OTP to proceed IFCI LTD";

        $url = "https://www.mysmsapp.in/api/push.json?apikey=".$this->API_KEY."&sender=".$this->SENDER_ID."&mobileno=".$mobileNumber."&text=".urlencode($message)."";

        // dd($message,$url);

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
        ));

            // dd($ch);
       // get response
        $output = curl_exec($ch);

        // dd($output);

       // Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);
        if ($isError) {
            return array('error' => 1, 'message' => $errorMessage);
        } else {
            return array('error' => 0,'message' => $output);
        }

    }
}
