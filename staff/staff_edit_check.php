<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false)
{
	print 'ログインされていません。<br />';
	print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print 'さんログイン中<br />';
	print '<br />';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ユビーネット</title>
</head>
<body>

<?php

$staff_code = $_POST['code'];
$staff_name = $_POST['name'];
$staff_pass = $_POST['pass'];
$staff_pass2 = $_POST['pass2'];

$staff_code = htmlspecialchars($staff_code);
$staff_name = htmlspecialchars($staff_name);
$staff_pass = htmlspecialchars($staff_pass);
$staff_pass2 = htmlspecialchars($staff_pass2);

if ($staff_name == '')
{
	print 'スタッフ名が入力されていません。<br />';
}
else
{
	print 'スタッフ名：';
	print $staff_name;
	print '<br />';
}

if ($staff_pass == '')
{
	print 'パスワードが入力されていません。<br />';
}

if ($staff_pass != $staff_pass2)
{
	print 'パスワードが一致しません。<br />';
}

if ($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2)
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	$staff_pass = md5($staff_pass);
	print '<form method="post" action="staff_edit_done.php">';
	print '<input type="hidden" name="code" value="'.$staff_code.'">';
	print '<input type="hidden" name="name" value="'.$staff_name.'">';
	print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';
}

?>

</body>
</html>