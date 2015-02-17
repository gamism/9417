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
