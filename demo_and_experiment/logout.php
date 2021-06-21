<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["userNAME"])) {
    header("Location: ./logout.php");
}

$_SESSION = array();

session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログアウト</title>
</head>
<body>
ログアウトしました。
<a href="./login.php">ログインページに戻る</a>

</body>
</html>