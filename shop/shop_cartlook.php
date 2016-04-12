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

if(isset($_SESSION['cart'])==true)
{
	$cart=$_SESSION['cart'];
	$kazu=$_SESSION['kazu'];
	$max=count($cart);
}
else
{
	$max=0;
}

if($max==0)
{
	print 'カートに商品が入っていません。<br />';
	print '<br />';
	print '<a href="shop_list.php">商品一覧へ戻る</a>';
	exit();
}

$dsn='mysql:dbname=rigee;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

foreach($cart as $key=>$val)
{
	$sql='SELECT code,name,price,special_price,gazou,model_code,tokutyo,size FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$val;
	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	if($rec['gazou']=='')
	{
		$pro_gazou[]='';
	}
	else
	{
		$pro_gazou[]='<img src="img/'.$rec['gazou'].'">';
	}
	$pro_name[]=$rec['name'];
	if($rec['code'] == date('w')+1){
		$pro_price[]=$rec['special_price'];
	}else{
		$pro_price[]=$rec['price'];
	}
	$pro_model_code[]=$rec['model_code'];
	$pro_size[]=$rec['size'];
	$pro_tokutyo[]=$rec['tokutyo'];
}

$dbh=null;

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

カートの中身<br />
<br />
<table border="1">
<tr>
<td>商品画像</td>
<td>商品名</td>
<td>型番</td>
<td>サイズ</td>
<td>特徴</td>
<td>価格</td>
<td>数量</td>
<td>小計</td>
<td>削除</td>
</tr>
<form method="post" action="kazu_change.php">
<?php for($i=0;$i<$max;$i++)
	{
?>
<tr>
	<td><?php print $pro_gazou[$i]; ?></td>
	<td><?php print $pro_name[$i]; ?></td>
	<td><?php print $pro_model_code[$i]; ?></td>
	<td><?php print $pro_size[$i]; ?></td>
	<td><?php print $pro_tokutyo[$i]; ?></td>
	<td><?php print $pro_price[$i]; ?>円</td>
	<td><input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>"></td>
	<td><?php print $pro_price[$i]*$kazu[$i]; ?>円</td>
	<td><input type="checkbox" name="sakujo<?php print $i; ?>"></td>
</tr>
<?php
	}
?>
</table>
<input type="hidden" name="max" value="<?php print $max; ?>">
<input type="submit" value="数量変更"><br />
<input type="button" onclick="history.back()" value="戻る">
</form>
<br />
<a href="shop_form.html">ご購入手続きへ進む</a><br />

<?php
	if(isset($_SESSION["member_login"])==true)
	{
		print '<a href="shop_kantan_check.php">会員かんたん注文へ進む</a><br />';
	}
?>

</body>
</html>