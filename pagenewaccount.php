<!-- make account pagenewaccount -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-アカウント作成</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div id="center">
	<h1>アカウント作成</h1>
	<form action="./pagemyhome.php" method="post">
		<label for="uid">&thinsp;&emsp;UserID:</label>
		<input type="id" name="uid" placeholder="UserID"><br>
		<label for="pass">Password:</label>
		<input type="password" name="pass" placeholder="Password"><br><br>
		<input type="submit" value="作成！">
	</form>
</div>
<?php include './footer.php' ?>
</body>

</html>
