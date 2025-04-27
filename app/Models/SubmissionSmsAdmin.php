<?php
namespace App\Models;

class SubmissionSmsAdmin
{

    function __construct()
    { }

    private $API_KEY = '662f606468e62';
    private $SENDER_ID = "IFCILT";
    // private $ROUTE_NO = 4;
    private $RESPONSE_TYPE = 'json';
	// private $DLT_TE_ID = 1207161770681245489;

    public function sendSMS($mobileNumber, $message, $module)
    {
        // dd($mobileNumber, $message, $module);
        $scheme = "PLI-WG";
        $isError = 0;
        $errorMessage = true;

        if ($module == 'Claim') {

            $message = "Dear Sir/Madam,%0A%0AClaim has been submitted by " . $message[1] . " for FY " . $message[0] . " %0A%0A" . $scheme . "%0AIFCI LTD";
 
            $url = "https://www.mysmsapp.in/api/push.json?apikey=" . $this->API_KEY . "&sender=" . $this->SENDER_ID . "&mobileno=" . $mobileNumber . "&text=" . $message . "";
 
        } elseif ($module == 'Baseline') {

                $message = "Dear Sir/Madam,%0A%0ABASELINE FORM has been submitted by " . $message[0] . ".%0A%0A" . $scheme . "%0AIFCI LTD";
     
                $url = "https://www.mysmsapp.in/api/push.json?apikey=" . $this->API_KEY . "&sender=" . $this->SENDER_ID . "&mobileno=" . $mobileNumber . "&text=" . $message . "";
     
        } elseif ($module == 'Qrr') {
  
            $message = "Dear Sir/Madam,%0A%0AQRR FY " . $message[0] ." Q".$message[1]." has been submitted by " . $message[2] . " %0A%0A" . $scheme . "%0AIFCI LTD";
 
            $url = "https://www.mysmsapp.in/api/push.json?apikey=" . $this->API_KEY . "&sender=" . $this->SENDER_ID . "&mobileno=" . $mobileNumber . "&text=" . $message . "";
 
        } elseif ($module == 'App') {
            
            $message = "Dear Sir/Madam,%0A%0AApplication " . $message[0] . " has been submitted by " . $message[1] . " %0A%0A" . $scheme . "%0AIFCI LTD";
 
            $url = "https://www.mysmsapp.in/api/push.json?apikey=" . $this->API_KEY . "&sender=" . $this->SENDER_ID . "&mobileno=" . $mobileNumber . "&text=" . $message . "";
 
        } elseif ($module == 'Correspondence') {
 
            $message = "Dear Sir/Madam,%0A%0AYour correspondence has been reverted, Kindly check the portal.%0A%0A" . $scheme . "%0AIFCI LTD";
 
            $url = "https://www.mysmsapp.in/api/push.json?apikey=" . $this->API_KEY . "&sender=" . $this->SENDER_ID . "&mobileno=" . $mobileNumber . "&text=" . $message . "";
        }

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
        ));

      
        $output = curl_exec($ch);
       
    
       // get response
        // $output = curl_exec($ch);

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
