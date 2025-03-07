<?php

function getMaxID($table)
{
    $maxid = DB::table($table)->max('id');
    if (!$maxid) {
        $maxid = 1;
    }

    return $maxid;
}

function getFinancialYear()
{
    //dd("");
    $year = date('Y');
    $month = date('m');
    if ($month < 4) {
        $year = $year - 1;
    }
    $nextYear = $year + 1;
    $financial_year = "$year-$nextYear";
    $sort_year = substr($year, -2);
    $response = array('financial_year' => $financial_year, 'sort_year' => $sort_year);
    return $response;

}

function get_target_segment()
{

    $target_segment = DB::table('eligible_products')->distinct('target_segment')->select('target_segment', 'target_id')->get();

    $arr_target_segment = array();

    foreach ($target_segment as $ts_value) {
        if ($ts_value->target_id != '' and $ts_value->target_segment != '') {
            $arr_target_segment[$ts_value->target_id] = $ts_value->target_segment;
        }
    }
    return $arr_target_segment;
}

function current_quarter()
{
    $curr_qtr = DB::table('qtrs')->where('status', 1)->orderBy('id', 'DESC')->first();
    //dd($curr_qtr);
    return $curr_qtr->id;
}

function CompanyName($id)
{
    $companyname = DB::table('users')->where('id', $id)->select('name')->first();

    return $companyname->name;

}

function errorMail($e, $id, $user_id)
{
    \Log::error($e->getMessage());
    report($e);
    $portal_name = 'PLIDRONE';
    // dd($e,$id,$user_id);
    $mail_details = DB::table('error_mail')->get();
    $dev_data = $mail_details->where('email_type', 'to')->first();
    $cc_details = $mail_details->where('email_type', 'cc');
    $user_data = DB::table('users')->where('id', $user_id)->first();

    foreach ($cc_details as $k => $val) {
        $cc[] = $val->email;
        $cc_per_name[] = $val->name;
    }

    $data = array(
        'name' => $dev_data->name,
        'to_email' => $dev_data->email,
        'error' => $e->getMessage(),
        'trace' => $e->getTrace(),
        'cc_email' => $cc,
        'cc_name' => $cc_per_name,
        'app_name' => $user_data->name,
        'pan' => $user_data->pan,
        'mobile' => $user_data->mobile,
        'contact_person' => $user_data->contact_person
    );

    \Mail::send('emails.exception', $data, function ($message) use ($data, $portal_name) {
        $message->to($data['to_email'], $data['name'])->subject
        ("Error Log || $portal_name");
        $message->cc($data['cc_email'], $data['cc_name']);
    });
    alert()->warning('Something Went Wrong', 'Warning')->persistent('Close');

}



