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
<link rel="stylesheet" type="text/css" href="./css/shop_list_css.css">
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

$dsn = 'mysql:dbname=rigee;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


$sql = 'SELECT count(*) as cnt FROM mst_product';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$data_cnt = $rec['cnt'];

for ($i=0; $i <= $data_cnt; $i++)
{
	$week = date('w') +1;
	if($i == 0)
	{
		$sql = 'SELECT name,tokutyo,price,special_price FROM mst_product WHERE code=?';
		$stmt = $dbh->prepare($sql);
		$data[] = $week;
		$stmt->execute($data);

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);

		print '<div id="main_contents"><a href="shop_product.php?procode=' .$week .'&specialprice=1"><img src="img/bm0' .$week .'.jpg"></a>';
		print '<div><span>今日の特価品</span><br><br>';
		print '<span>'.$rec["name"] .'</span><br><br>';
		print $rec['tokutyo'].'<br><br>';
		echo $rec["special_price"], '円（税抜き）<br>';
		print '<br><input type="button" value="カートに入れる" onclick="location.href=\'shop_cartin.php?procode='.$week .'\'"></div></div><br />';
	}
	else if($i == $week)
	{
	}
	else
	{
		$i_strlen = strlen($i);
		if($i_strlen == 1)
		{
			print '<a href="shop_product.php?procode=' .$i .'&specialprice=1"><img src="img/bm0' .$i .'s.jpg"></a>';
		}
		else
		{
			print '<a href="shop_product.php?procode=' .$i .'&specialprice=1"><img src="img/bm' .$i .'s.jpg"></a>';
		}
	}
}
$dbh = null;

}catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

</body>
</html>