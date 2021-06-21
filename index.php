<!-- index pagelogin -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-ログインページ</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>
<div class="center">
	<h1>ログイン</h1>
	<form action="./pagemyhome.php" method="post">
		<label for="username">Username:</label>
		<input type="text" class="textbox1" name="username" placeholder="Username"><br>
		<label for="pass">&nbsp;Password:</label>
		<input type="password" class="textbox2" name="pass" placeholder="Password"><br>
		<input type="submit" id="login" value="ログイン">
	</form>
	<br><button class="registration"onclick="location.href='./pagenewaccount.php'">アカウント新規登録<br>初めての方はこちら</button>
</div>
<?php include './footer.php' ?>
</body>

</html>
