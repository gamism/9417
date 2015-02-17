<?php
/**
 * Created by PhpStorm.
 * User: stevenPC
 * Date: 2015/2/14
 * Time: 上午 12:13
 */

require_once("function.php");

$target_id = isempty($_GET['id'], 1);
$t = curl("http://api.yi18.net/cook/show", "id=" . $target_id, 1);
//echo $t;
$t = json_decode($t);
$data = $t->yi18;
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<title><?=$data->name?> | <?=$data->food?> | 9417</title>
	<script src="js/http_code.jquery.com_jquery-2.1.3.js"></script>
	<link rel="stylesheet" href="css/uikit.min.css" />
	<script src="js/uikit.min.js"></script>
	<script src="js/common.js"></script>
</head>
<body>

<div class="uk-grid">
    <div class="uk-width-8-10 uk-align-center">
        <div class="uk-panel">
            <div class="uk-panel-box">
                食譜ID : <?=$data->id?> <br/>
                食譜名稱 : <?=$data->name?> <br/>
                標籤 : <?=$data->tag?> <br/>
                食材 : <?=$data->food?> <br/>
            </div>
            <div class="uk-panel-box uk-panel-box-primary">
                食譜的主要做法 : <?=$data->message?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
