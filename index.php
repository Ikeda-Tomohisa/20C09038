<!-- index pagelogin -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-ログインページ</title>
<link rel="stylesheet" href="./style.css">
</head>

<body>
<?php include './header.php' ?>
<div id="right"><a href="pagenewaccount.php">新しいアカウント作成</a></div>
<div id="center">
	<h1>ログイン</h1>
	<form action="./pagemyhome.php" method="post">
		<label for="uid">&thinsp;&emsp;UserID:</label>
		<input type="id" name="uid" placeholder="UserID"><br>
		<label for="pass">Password:</label>
		<input type="password" name="pass" placeholder="Password"><br><br>
		<input type="submit" value="ログイン">
	</form>
</div>
<?php include './footer.php' ?>
</body>

</html>
