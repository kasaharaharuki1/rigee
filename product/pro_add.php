<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ユビーネット</title>
</head>
<body>

商品追加<br />
<br />
<form method="post" action="pro_add_check.php" enctype="multipart/form-data">
商品名を入力してください。<br />
<input type="text" name="name" style="width:200px"><br />
通常価格を入力してください。<br />
<input type="text" name="price" style="width:50px">　円（税抜き）<br />
特価価格を入力してください。<br />
<input type="text" name="special_price" style="width:50px">　円（税抜き）<br />
<!-- 特価曜日を選択してください。<br />
<input type="radio" name="q1" value="sun"> 日曜日
<input type="radio" name="q1" value="Mon"> 月曜日
<input type="radio" name="q1" value="Tues">火曜日
<input type="radio" name="q1" value="Wed">水曜日
<input type="radio" name="q1" value="Thurs">木曜日
<input type="radio" name="q1" value="Fri">金曜日
<input type="radio" name="q1" value="Sat">土曜日 <br />-->
画像(大）を選んでください。<br />
<input type="file" name="gazou_l" style="width:400px"><br />
画像(小）を選んでください。<br />
<input type="file" name="gazou_s" style="width:400px"><br />
型番を入力してください。<br />
<input type="text" name="kataban" style="width:100px"><br />
サイズを入力してください。<br />
<input type="text" name="size" style="width:100px"> inch<br />
特徴を入力してください。<br />
<textarea name="tokutyo" cols="50" rows="4">

</textarea>
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</form>

</body>
</html>