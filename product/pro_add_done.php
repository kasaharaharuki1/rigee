<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユビーネット</title>
</head>
<body>

<?php

try
{

$pro_name=$_POST['name'];
$pro_price=$_POST['price'];
$pro_gazou_name=$_POST['gazou_name'];
//追加------------------------------------------------
$pro_sp_price=$_POST['sp_price'];
$pro_kataban=$_POST['kataban'];
$pro_size=$_POST['size'];
$pro_tokutyo=$_POST['tokutyo'];
//-------------------------------------------------
$pro_name=htmlspecialchars($pro_name);
$pro_price=htmlspecialchars($pro_price);

//追加-------------------------------------------
$pro_sp_price=htmlspecialchars($pro_sp_price);
$pro_kataban=htmlspecialchars($pro_kataban);
$pro_size=htmlspecialchars($pro_size);
$pro_tokutyo=htmlspecialchars($pro_tokutyo);
//------------------------------------------------


$dsn='mysql:dbname=rigee;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='INSERT INTO mst_product(name,price,gazou,special_price,model_code,size,tokutyo) VALUES (?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$pro_name;
$data[]=$pro_price;
$data[]=$pro_gazou_name;
$data[]=$pro_sp_price;
$data[]=$pro_kataban;
$data[]=$pro_size;
$data[]=$pro_tokutyo;
$stmt->execute($data);

$dbh=null;

print $pro_name;
print 'を追加しました。<br />';

}
catch(Exception$e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<a href="pro_list.php">戻る</a>

</body>
</html>