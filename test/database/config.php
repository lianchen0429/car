<?php
$server = "localhost";
$username = "root";
$password = "321";
$database_name = 'shopcar';
$link = mysql_connect($server, $username, $password);
if (!$link) {
    die('連線失敗');
}
$db = mysql_selectdb($database_name, $link);
mysql_query("SET NAMES 'utf8'");
if (!$db) {
    die('資料庫無法開啟');
}
date_default_timezone_set("Asia/Taipei");
  	//echo '資料庫開啟成功';
  	?>