<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["userNAME"])) {
    header("Location: ./pagelogin.php");
}

$_SESSION = array();

//セッションクッキーの削除
if (isset($_COOKIE["PHPSESSID"])) {
	setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();
?>

<?php include '../globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<title>myapp-ログアウト</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php include '../header.php' ?>

<div class="center">
<h1>ログアウト<span>logout</span></h1>
<div>ログアウトしました。<br>
     Logged out.
</div><br>

<a href="./pagelogin.php">ログインへ / to login</a>
</div>

<?php include '../footer.php' ?>
</body>
</html>