<?php
session_start();
?>

<?php include '../globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-アカウント新規登録完了</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php include '../header.php' ?>

<div class="center">
	<h1>アカウント新規登録-完了</h1>
	<p>こちらの情報で登録しました</p><br>
	<?php echo "Username:",$_SESSION["username"] ?><br>
	<?php echo "Password:",$_SESSION["userpass"] ?><br><br>
	<button onclick="location.href='../pagemyhome.php'">マイホームへ</button>
</div>
<?php include '../footer.php' ?>
</body>

</html>
