<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユビーネット</title>
</head>
<body>

<?php

$pro_name=$_POST['name'];
$pro_price=$_POST['price'];
$pro_sp_price=$_POST['special_price'];
$pro_gazou_l=$_FILES['gazou_l'];
$pro_gazou_s=$_FILES['gazou_s'];
$pro_kataban=$_POST['kataban'];
$pro_size=$_POST['size'];
$pro_tokutyo=$_POST['tokutyo'];


$pro_name=htmlspecialchars($pro_name);
$pro_price=htmlspecialchars($pro_price);
$pro_sp_price=htmlspecialchars($pro_sp_price);
$pro_kataban=htmlspecialchars($pro_kataban);
$pro_size=htmlspecialchars($pro_size);
$pro_tokutyo=htmlspecialchars($pro_tokutyo);


if($pro_name=='')
{
	print '商品名が入力されていません。<br />';
}
else
{
	print '商品名:';
	print $pro_name;
	print '<br />';
}
//通常価格入力判断
if(preg_match('/^[0-9]+$/',$pro_price)==0)
{
	print '通常価格をきちんと入力してください。<br />';
}
else
{
	print '通常価格:';
	print $pro_price;
	print '円<br />';
}
//特価価格入力判断
if(preg_match('/^[0-9]+$/',$pro_sp_price)==0)
{
	print '特価価格をきちんと入力してください。<br />';
}
else
{
	print '特価価格:';
	print $pro_sp_price;
	print '円<br />';
}
//型番入力判断
if($pro_kataban=='')
{
	print '型番が入力されていません。<br />';
}
else
{
	print '型番:';
	print $pro_kataban;
	print '<br />';
}
if($pro_size=='')
{
	print '商品サイズが入力されていません。<br />';
}
else
{
	print 'サイズ:';
	print $pro_size;
	print '<br />';
}
//商品特徴入力判断
if(isset($pro_tokutyo))
{
	print '商品特徴:';
	print $pro_tokutyo;
	print '<br />';
}
else
{

	print '商品特徴が入力されていません。<br />';
	print $pro_tokutyo;
}

if($pro_gazou_l['size']>0)
{
	if($pro_gazou_l['size']>1000000)
	{
		print '画像(大）が大き過ぎます';
		print '<br />';
	}
	else
	{
		$dsn='mysql:dbname=rigee;host=localhost;charset=utf8';
		$user='root';
		$password='';
		$dbh=new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql = 'SELECT count(*) as cnt FROM mst_product';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);

		$data_cnt = $rec['cnt'];

		$i_strlen = strlen($data_cnt +1);
		$d = $data_cnt +1;
		$string="bm";


		if($i_strlen == 1)
		{
			$string.='0'.$d.'.jpg';
		}else{
			$string.=$d.'.jpg';

		}
		print $string;
		move_uploaded_file($pro_gazou_l['tmp_name'],'../shop/img/'.$string);
		print '商品画像（大)';
		print '<br />';
		print '<img src="../shop/img/' .$string .'">';
		print '<br />';
			/* move_uploaded_file($pro_gazou_l['tmp_name'],'../shop/img/bm0' .$d .'.jpg');
			print '商品画像（大)';
			print '<br />';
			print '<img src="../shop/img/bm0' .$d .'.jpg">';
			print '<br />';
		}
		else
		{
			move_uploaded_file($pro_gazou_l['tmp_name'],'./shop/img/bm' .$d .'.jpg');
			print '商品画像（大)';
			print '<br />';
			print '<img src="../shop/img/bm0' .$d .'.jpg">';
			print '<br />';
		}*/
	}
		$dbh = null;
}
else
{
	print '画像（大）を選択してください';
	print '<br />';
}
if($pro_gazou_s['size']>0)
{
	if($pro_gazou_s['size']>1000000)
	{
		print '画像（小）が大き過ぎます';
		print '<br />';
	}
	else
	{
		move_uploaded_file($pro_gazou_s['tmp_name'],'./gazou/'.$pro_gazou_s['name']);
		print '商品画像（小)';
				print '<br />';
		print '<img src="./gazou/'.$pro_gazou_s['name'].'">';
		print '<br />';
	}
}else{
	print '画像（小）を選択してください';
	print '<br />';
}

if($pro_name=='' || preg_match('/^[0-9]+$/',$pro_price)==0 || preg_match('/^[0-9]+$/',$pro_sp_price)==0|| $pro_gazou_l['size']>1000000 || $pro_gazou_s['size']>1000000
		 ||$pro_gazou_l['size']<=0  || $pro_gazou_s['size']<=0 || $pro_kataban==''|| $pro_size==''
		  || !isset($pro_tokutyo))
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	print '上記の商品を追加します。<br />';

	print '<form method="post" action="pro_add_done.php">';
	print '<input type="hidden" name="name" value="'.$pro_name.'">';
	print '<input type="hidden" name="price" value="'.$pro_price.'">';
	print '<input type="hidden" name="gazou_name" value="'.$string .'">';

	//追加-------------------------------------------------------------------------------------

	print '<input type="hidden" name="sp_price" value="'.$pro_sp_price.'">';
	print '<input type="hidden" name="kataban" value="'.$pro_kataban.'">';
	print '<input type="hidden" name="size" value="'.$pro_size.'">';
	print '<input type="hidden" name="tokutyo" value="'.$pro_tokutyo.'">';
//----------------------------------------------------------------------------------------
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';
}

?>
</body>
</html>