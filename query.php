<?php
/**
 * Created by PhpStorm.
  * User: S101319
   * Date: 2015/2/11
    * Time: 下午 1:02
     */
//phpinfo();
$action = $_GET["action"];

switch ($action) {
     case 'search':
          search();
          break;
     case 'detail':
          detail();
          break;
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

function detail()
{
     $did = $_GET["id"];
     $url = "http://api.yi18.net/cook/show";
     $data = "id=" . $did;
     curl($url, $data);
}

function search()
{
     $key = $_GET["key"];
     $lmt = $_GET["lmt"];
     $pg = $_GET["pg"];
     $url = "http://api.yi18.net/cook/search";
     $data = "page=" . $pg . "&limit=" . $lmt . "&keyword=" . $key;
     curl($url, $data);
}
