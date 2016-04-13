<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="./css/shop_header_css.css">
<title>ユビーネット</title>
</head>
<body>
<div id="header">
	<div id="header_contents">
	<input type="image" src="img/logo-rigee.png">
	<input type="image" src="img/logo-t.png">
	<input type="image" src="img/nav01.png" onclick="location.href='shop_list.php'">
	</div>
</div>

ログアウトしました。<br />
<br />
<a href="shop_list.php">商品一覧へ</a>

</body>
</html>