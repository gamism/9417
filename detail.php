<?php
/**
 * Created by PhpStorm.
 * User: stevenPC
 * Date: 2015/2/14
 * Time: 上午 12:13
 */

require_once("query.php");

$t = curl("http://api.yi18.net/cook/show", "id=530", 1);
//echo $t;
$t = json_decode($t);
$name = $t->yi18->name;
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<title><?php echo $name?> | 9417</title>
	<script src="js/http_code.jquery.com_jquery-2.1.3.js"></script>
	<link rel="stylesheet" href="css/uikit.min.css" />
	<script src="js/uikit.min.js"></script>
	<script src="js/common.js"></script>
</head>
<body>
<script>
	var detail = {food:"食材", id:"食譜ID", name:"食譜名稱", tag:"標籤", bar:"食品 主要的功能", message:"食譜的主要做法", count:"瀏覽次數"};
	var detail_array=[],
		detail_id = getParameterByName('did') || "56045";
	for (var i in detail)
	{
		detail_array.push(i);
	}
	console.log(detail_array);
	$.get("query.php", {action:"detail", id:detail_id}, function (xhr) {
		if(xhr)
		{
			if(xhr.success)
			{
				console.log(xhr.yi18);
				for(var item in xhr.yi18)
				{
					console.log("going to ", item);
//					if($.inArray(item, detail_array) > -1)
					{
						console.log(item);
//						document.write(detail[item] + " : " + xhr.yi18[item] + "<br/>");
//						document.write(item + " : " + xhr.yi18[item] + "<br/>");
					}

				}
			}
		}
	}, "json");
</script>
done
</body>
</html>
