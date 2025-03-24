<?php
namespace App\Models;

class SubmissionSms
{

    function __construct()
    { }

    private $API_KEY = '662f606468e62';
    private $SENDER_ID = "IFCILT";
    // private $ROUTE_NO = 4;
    private $RESPONSE_TYPE = 'json';
	// private $DLT_TE_ID = 1207161770681245489;



    public function sendSMS($mobileNumber, $module, $com_name, $user_id, $password, $bank_name)
    {
        // dd($mobileNumber, $module, $com_name, $user_id, $password, $bank_name);
        $isError = 0;
        $errorMessage = true;

        if ($module == 'Company-Created') {
            // dd('cre');

            $message =  "Dear ".$com_name.",%0A%0APlease find your IFCI ESG Portal login details below: %0A%0AUsername: ".$user_id. "%0APassword: ".$password."%0AURL: https://esg.ifciltd.com/ %0A%0ARegards, %0A".$bank_name." %0A%0AWe thank you for your cooperation!";

            $url = "https://www.mysmsapp.in/api/push.json?apikey=".$this->API_KEY."&sender=".$this->SENDER_ID."&mobileno=".$mobileNumber."&text=".$message."";

        }
        elseif ($module == 'Calculator')
        {
            // dd('cal');

            $message =  "Dear ".$com_name.",%0A%0APlease find your IFCI ESG Portal login details below: %0A%0AUsername: ".$user_id. "%0APassword: ".$password."%0AURL: https://esg.ifciltd.com/ %0A%0ARegards, %0A".$bank_name." %0A%0AWe thank you for your cooperation!";
            // $message = "One Time Passowrd(OTP) for Login: " . $password. " Do not share this OTP with anyone! IFCI Ltd";

            $url = "https://www.mysmsapp.in/api/push.json?apikey=".$this->API_KEY."&sender=".$this->SENDER_ID."&mobileno=".$mobileNumber."&text=".$message."";
            
        }

        // dd($url);

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
        ));


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
