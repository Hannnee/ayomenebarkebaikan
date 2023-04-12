<?php

use Illuminate\Support\Facades\Session;

/**
 * @param
 * @return
 */
function active_menu($param)
{
    if (request()->is($param) || request()->is($param."/*")) {
        return "active current-page";
    }
}

/**
 * @param
 * @param
 */
function alert($status, $message)
{
    Session::flash('status', $status);
    Session::flash('messages', $message);
}

/**
 * @param
 * @return
 */
function to_rupiah($price)
{
    return "Rp ".number_format($price ,0,',','.');
}

/**
 * @param
 * @return
 */
function to_number($price)
{
    $value = preg_replace("/[^0-9]/", "", $price);
    $value = str_replace(".", "", $value);
    return $value;
}
