<?php

function getProduct($id)
{
    $prod = DB::table('eligible_products')->where('id',$id)->first();

    return $prod;
}

function check($app_id, $id)
{
    $flag = DB::table('add_product_det')->where('app_id',$app_id)->where('p_id',$id)->first();
    // dd($flag,$id);

    return $flag;
}

function tsCount($ts){
    $rowcount = DB::table('other_eligible_products')->where('target_id',$ts)->count();
    // dd($rowcount);

    return $rowcount;
}

