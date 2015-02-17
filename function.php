<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/17/15
 * Time: 4:23 PM
 */

function isempty($d, $default)
{
    return (!empty($d) ? $d : $default);
}

function curl($url, $data, $opt = 0)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); /* obey redirects */
    curl_setopt($ch, CURLOPT_HEADER, 0);  /* No HTTP headers */
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  /* return the data */

    $result = curl_exec($ch);

    curl_close($ch);

    if($opt) {
        return $result;
    }
    else {
        header("Content-Type:text/html; charset=utf-8");
        echo $result;
    }
}