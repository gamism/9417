<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/17/15
 * Time: 4:12 PM
 */

require_once("function.php");

$page_id = isempty($_GET['page'], 1);
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>SEARCH | 9417</title>
    <script src="js/http_code.jquery.com_jquery-2.1.3.js"></script>
    <link rel="stylesheet" href="css/uikit.min.css" />
    <script src="js/uikit.min.js"></script>
</head>
<body>
<div class="uk-grid">
    <div class="uk-width-8-10 uk-align-center">
        <div class="uk-panel-box uk-align-center">
            <input type="text" id="keyword"/>
            <select id="limit" onchange="search(1)">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20" selected>20</option>
            </select>
            <br/>
            <input type="button" value="SEARCH" class="uk-width-4-10 uk-button-large" onclick="search()"/>
        </div>
    </div>
    <div class="uk-width-8-10 uk-align-center">
        <div id="test" class="uk-width-1-1 uk-text-right"></div>
    </div>
    <div class="uk-width-8-10 uk-align-center">
        <ul id="test2" class="uk-list uk-list-striped"></ul>
    </div>
</div>

<script>
    function pageChange(p, method)
    {
        $('#pages').val(p+method);
        search(0);
    }
    function search(change_target)
    {
        change_target = change_target || 0;
        var keyword=document.getElementById('keyword').value;
        var limit = document.getElementById('limit').value,
            pages = (document.getElementById('pages'))?document.getElementById('pages').value: 1;

        pages = (change_target) ? 1 : pages;
        if (keyword.length)
        {
//            console.info('limit ',limit, ' pages ', pages, ' ', keyword);
            $.get("query.php", {action:"search", key:keyword, lmt:limit, pg:pages}, function(xhr)
            {
                if(xhr)
                {
//                    console.log(xhr);
                    if(xhr.success)
                    {
                        var i, item, tmp_str="", tmp_str2="", tmp_pages=Math.ceil(xhr.total/limit);
                        tmp_str += "search result : <span id='total'>" + xhr.total + "</span><br/>";

                        if(xhr.yi18.length)
                        {
                            tmp_str += "total pages : " + tmp_pages + "<br/>";

                            if(tmp_pages > 1)
                            {
                                tmp_str+="GO TO : <select id=\"pages\" onchange=\"search()\">";
                                for(i=1; i<=tmp_pages; i++)
                                {
                                    tmp_str+="<option value=\""+i+"\">page "+i+"</option>";
                                }
                                tmp_str+="</select>";
                                tmp_str+='<ul class="uk-pagination">';
                                tmp_str+='<li class="uk-pagination-previous '+((pages != 1)?'uk-active':'uk-disabled')+'"><span onclick="pageChange('+pages+', -1)">previous</span></li>';
                                tmp_str+='<li class="uk-pagination-next '+((pages != tmp_pages)?'uk-active':'uk-disabled')+'"><span onclick="pageChange('+pages+', 1)">next</span></li>';
                                tmp_str+='</ul>';
                            }
                            for(i=0; i<xhr.yi18.length; i++)
                            {
                                item=xhr.yi18[i];
//								tmp_str+="<img src='http://www.yi18.net/"+item.img+"'/>";
                                tmp_str2+="<li>";
                                tmp_str2+=item.name;
                                tmp_str2+=" | id : <a href='detail.php?id="+item.id+"' target=_blank >"+item.id+"</a>";
//                                tmp_str2+=" | type: "+item.type;
//								tmp_str+="<br/>";
//								tmp_str+="keywords: "+item.keywords;
//								tmp_str+="<br/>";
//								tmp_str+="description: "+item.description;
//								tmp_str+="<br/>";
//								tmp_str+="content: "+item.content;
                                tmp_str2+="</li>";
                            }
                            document.getElementById('test').innerHTML=tmp_str;
                            document.getElementById('test2').innerHTML=tmp_str2;
                        }
                        $('#pages').val((pages > tmp_pages) ? tmp_pages : pages);
                    }
                }
            }, "json")
        }
    }
</script>
</body>
</html>