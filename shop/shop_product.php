<?php
session_start();
session_regenerate_id(true);
$cartkazu = isset($_SESSION['cartkazu']) ? $_SESSION['cartkazu'] : "0";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユビーネット</title>
</head>
<body>

<div>
	<img src="img/logo-rigee.png">
	<input type="image" src="img/nav01.png" onclick="location.href='shop_list.php'">
	<input type="text" value="現在のカート:<?php print $_SESSION['cartkazu']; ?>" readonly="readonly">
	<input type="button" value="カートを見る" onclick="location.href='shop_cartlook.php'">
	<?php
		if (isset($_SESSION['member_login']) == false)
		{
			print 'ようこそゲスト様　';
			print '<a href="member_login.html">会員ログイン</a><br />';
			print '<br />';
		}
		else
		{
			print 'ようこそ';
			print $_SESSION['member_name'];
			print '様　';
			print '<a href="member_logout.php">ログアウト</a><br />';
			print '<br />';
		}
	?>
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

<?php print $disp_gazou; ?>
<br />
<br />
<div>
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