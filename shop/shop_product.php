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
$special_price = $_GET['specialprice'];

$dsn = 'mysql:dbname=rigee;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

if($special_price == "0")
{
	$sql = 'SELECT name,price,gazou,model_code,tokutyo,size FROM mst_product WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $pro_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$pro_name = $rec['name'];
	$pro_price = $rec['price'];
	$pro_gazou_name = $rec['gazou'];
	$pro_model_code = $rec['model_code'];
	$pro_tokutyo = $rec['tokutyo'];
	$pro_size = $rec['size'];
}
else
{
	$sql = 'SELECT name,special_price,gazou,model_code,tokutyo,size FROM mst_product WHERE code=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $pro_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$pro_name = $rec['name'];
	$pro_special_price = $rec['special_price'];
	$pro_gazou_name = $rec['gazou'];
	$pro_model_code = $rec['model_code'];
	$pro_tokutyo = $rec['tokutyo'];
	$pro_size = $rec['size'];
}

$dbh = null;

if ($pro_gazou_name == '')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="img/'.$pro_gazou_name.'">';
}
print "<h1>商品情報</h1>";
print '<a href="shop_cartin.php?procode='.$pro_code.'">カートに入れる</a><br /><br />';
}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<div>
	<?php print $disp_gazou; ?><br />
	商品名<br />
	<?php print $pro_name; ?>
	<br />
	<br />
	型番<br />
	<?php print $pro_model_code; ?>
	<br />
	<br />
	価格<br />
	<?php if($special_price == "0"){print $pro_price;}else{print $pro_special_price;} ?>
	<br />
	<br />
	サイズ<br />
	<?php print $pro_size; ?>
	<br />
	<br />
	特徴<br />
	<?php print $pro_tokutyo; ?>
</div>

</body>
</html>