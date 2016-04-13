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
	<input type="text" value="現在のカート:<?php print $cartkazu; ?>" readonly="readonly">
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

$dsn = 'mysql:dbname=rigee;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$week = date('w') +1;
print $week;

for ($i=1; $i <= 7; $i++)
{
	if($i == 1)
	{
		$sql = 'SELECT name,tokutyo,price,special_price FROM mst_product WHERE code=?';
		$stmt = $dbh->prepare($sql);
		$data[] = $week;
		$stmt->execute();

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);

		print '<a href="shop_product.php?procode=' .$week .'&specialprice=1"><img src="img/bm01.jpg"></a>';
		print '<div>今日の特価品<br><br>';
		print $rec['name'];
		print '<br>';
		print $rec['tokutyo'];
		print "<br>";
		echo $rec['special_price'], "円（税抜き）";
		print '<br><a href="shop_cartin.php?procode=' .$week .'">カートに入れる</a><div><br />';
	}

}
/*
switch (date('w')) {
	//日曜日
	case 0:
		print '<a href="shop_product.php?procode=1&specialprice=1"><img src="img/bm01.jpg"></a>';

		print '<div>今日の特価品<br><br>';
		print $rec['name'];
		print '<br>';
		print $rec['tokutyo'];
		print "<br>";
		echo $rec['special_price'], "円（税抜き）";
		print '<br><a href="shop_cartin.php?procode=1">カートに入れる</a><div><br />';

		print "<br>";
		print '<a href="shop_product.php?procode=2&specialprice=0"><img src="img/bm02s.jpg"></a>';
		print '<a href="shop_product.php?procode=3&specialprice=0"><img src="img/bm03s.jpg"></a>';
		print '<a href="shop_product.php?procode=4&specialprice=0"><img src="img/bm04s.jpg"></a><br>';
		print '<a href="shop_product.php?procode=5&specialprice=0"><img src="img/bm05s.jpg"></a>';
		print '<a href="shop_product.php?procode=6&specialprice=0"><img src="img/bm06s.jpg"></a>';
		print '<a href="shop_product.php?procode=7&specialprice=0"><img src="img/bm07s.jpg"></a>';
		break;
	case 1:
		print '<a href="shop_product.php?procode=2&specialprice=1"><img src="img/bm02.jpg"></a>';

		print '<div>今日の特価品<br><br>';
		print $rec['name'];
		print '<br>';
		print $rec['tokutyo'];
		print "<br>";
		echo $rec['special_price'], "円（税抜き）";
		print '<br><a href="shop_cartin.php?procode=2">カートに入れる</a><div><br />';

		print "<br>";
		print '<a href="shop_product.php?procode=3&specialprice=0"><img src="img/bm03s.jpg"></a>';
		print '<a href="shop_product.php?procode=4&specialprice=0"><img src="img/bm04s.jpg"></a>';
		print '<a href="shop_product.php?procode=5&specialprice=0"><img src="img/bm05s.jpg"></a><br>';
		print '<a href="shop_product.php?procode=6&specialprice=0"><img src="img/bm06s.jpg"></a>';
		print '<a href="shop_product.php?procode=7&specialprice=0"><img src="img/bm07s.jpg"></a>';
		print '<a href="shop_product.php?procode=1&specialprice=0"><img src="img/bm01s.jpg"></a>';
		break;
	case 2:
		//火曜日 テスト
		//特価品
		print '<a href="shop_product.php?procode=3&specialprice=1"><img src="img/bm03.jpg"></a>';

		print '<div>今日の特価品<br><br>';
		print $rec['name'];
		print '<br>';
		print $rec['tokutyo'];
		print "<br>";
		echo $rec['special_price'], "円（税抜き）";
		print '<br><a href="shop_cartin.php?procode=3">カートに入れる</a><div><br />';

		print "<br>";
		print '<a href="shop_product.php?procode=4&specialprice=0"><img src="img/bm04s.jpg"></a>';
		print '<a href="shop_product.php?procode=5&specialprice=0"><img src="img/bm05s.jpg"></a>';
		print '<a href="shop_product.php?procode=6&specialprice=0"><img src="img/bm06s.jpg"></a><br>';
		print '<a href="shop_product.php?procode=7&specialprice=0"><img src="img/bm07s.jpg"></a>';
		print '<a href="shop_product.php?procode=1&specialprice=0"><img src="img/bm01s.jpg"></a>';
		print '<a href="shop_product.php?procode=2&specialprice=0"><img src="img/bm02s.jpg"></a>';
		break;
	case 3:
		print '<a href="shop_product.php?procode=4&specialprice=1"><img src="img/bm04.jpg"></a>';

		print '<div>今日の特価品<br><br>';
		print $rec['name'];
		print '<br>';
		print $rec['tokutyo'];
		print "<br>";
		echo $rec['special_price'], "円（税抜き）";
		print '<br><a href="shop_cartin.php?procode=4">カートに入れる</a><div><br />';

		print "<br>";
		print '<a href="shop_product.php?procode=5&specialprice=0"><img src="img/bm05s.jpg"></a>';
		print '<a href="shop_product.php?procode=6&specialprice=0"><img src="img/bm06s.jpg"></a>';
		print '<a href="shop_product.php?procode=7&specialprice=0"><img src="img/bm07s.jpg"></a><br>';
		print '<a href="shop_product.php?procode=1&specialprice=0"><img src="img/bm01s.jpg"></a>';
		print '<a href="shop_product.php?procode=2&specialprice=0"><img src="img/bm02s.jpg"></a>';
		print '<a href="shop_product.php?procode=3&specialprice=0"><img src="img/bm03s.jpg"></a>';
		break;
	case 4:
		print '<a href="shop_product.php?procode=5&specialprice=1"><img src="img/bm05.jpg"></a>';

		print '<div>今日の特価品<br><br>';
		print $rec['name'];
		print '<br>';
		print $rec['tokutyo'];
		print "<br>";
		echo $rec['special_price'], "円（税抜き）";
		print '<br><a href="shop_cartin.php?procode=3">カートに入れる</a><div><br />';

		print "<br>";
		print '<a href="shop_product.php?procode=6&specialprice=0"><img src="img/bm06s.jpg"></a>';
		print '<a href="shop_product.php?procode=7&specialprice=0"><img src="img/bm07s.jpg"></a>';
		print '<a href="shop_product.php?procode=1&specialprice=0"><img src="img/bm01s.jpg"></a><br>';
		print '<a href="shop_product.php?procode=2&specialprice=0"><img src="img/bm02s.jpg"></a>';
		print '<a href="shop_product.php?procode=3&specialprice=0"><img src="img/bm03s.jpg"></a>';
		print '<a href="shop_product.php?procode=4&specialprice=0"><img src="img/bm04s.jpg"></a>';
		break;
	case 5:
		print '<a href="shop_product.php?procode=6&specialprice=1"><img src="img/bm06.jpg"></a>';

		print '<div>今日の特価品<br><br>';
		print $rec['name'];
		print '<br>';
		print $rec['tokutyo'];
		print "<br>";
		echo $rec['special_price'], "円（税抜き）";
		print '<br><a href="shop_cartin.php?procode=6">カートに入れる</a><div><br />';

		print "<br>";
		print '<a href="shop_product.php?procode=7&specialprice=0"><img src="img/bm07s.jpg"></a>';
		print '<a href="shop_product.php?procode=1&specialprice=0"><img src="img/bm01s.jpg"></a>';
		print '<a href="shop_product.php?procode=2&specialprice=0"><img src="img/bm02s.jpg"></a><br>';
		print '<a href="shop_product.php?procode=3&specialprice=0"><img src="img/bm03s.jpg"></a>';
		print '<a href="shop_product.php?procode=4&specialprice=0"><img src="img/bm04s.jpg"></a>';
		print '<a href="shop_product.php?procode=5&specialprice=0"><img src="img/bm05s.jpg"></a>';
		break;
	case 6:
		print '<a href="shop_product.php?procode=7&specialprice=1"><img src="img/bm07.jpg"></a>';

		print '<div>今日の特価品<br><br>';
		print $rec['name'];
		print '<br>';
		print $rec['tokutyo'];
		print "<br>";
		echo $rec['special_price'], "円（税抜き）";
		print '<br><a href="shop_cartin.php?procode=7">カートに入れる</a><div><br />';

		print "<br>";
		print '<a href="shop_product.php?procode=1&specialprice=0"><img src="img/bm01s.jpg"></a>';
		print '<a href="shop_product.php?procode=2&specialprice=0"><img src="img/bm02s.jpg"></a>';
		print '<a href="shop_product.php?procode=3&specialprice=0"><img src="img/bm03s.jpg"></a><br>';
		print '<a href="shop_product.php?procode=4&specialprice=0"><img src="img/bm04s.jpg"></a>';
		print '<a href="shop_product.php?procode=5&specialprice=0"><img src="img/bm05s.jpg"></a>';
		print '<a href="shop_product.php?procode=6&specialprice=0"><img src="img/bm06s.jpg"></a>';
		break;
}
*/
$dbh = null;

}catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

</body>
</html>