<?php
session_start();
session_regenerate_id(true);
$cartkazu = isset($_SESSION['cartkazu']) ? $_SESSION['cartkazu'] : "0";
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
	<input type="button" value="カートを見る" onclick="location.href='shop_cartlook.php'">
	<input type="text" value="現在のカート:<?php print $cartkazu; ?>" readonly="readonly">
	<?php
		if (isset($_SESSION['member_login']) == false)
		{
			print '<div>ようこそゲスト様　';
			print '<a href="member_login.html">会員ログイン</a></div>';
		}
		else
		{
			print '<div>ようこそ';
			print $_SESSION['member_name'];
			print '様　';
			print '<a href="member_logout.php">ログアウト</a></div>';
		}
	?>
	</div>
</div>

<?php

try
{

$pro_code = $_GET['procode'];

if (isset($_SESSION['cart']) == true)
{
	$cart = $_SESSION['cart'];
	$kazu = $_SESSION['kazu'];
	if (in_array($pro_code,$cart) == true)
	{
		print 'その商品はすでにカートに入っています。<br />';
		print '<a href="shop_list.php">商品一覧に戻る</a>';
		exit();
	}
}
$cart[] = $pro_code;
$kazu[] = 1;
$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;
if (isset($_SESSION['cartkazu']))
{
	$_SESSION['cartkazu'] +=1;
}

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

カートに追加しました。<br />
<br />
<a href="shop_list.php">商品一覧に戻る</a>

</body>
</html>