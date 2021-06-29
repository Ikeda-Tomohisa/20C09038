<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["userNAME"])) {
    header("Location: ./pagelogout.php");
    exit;
}

if ($_SESSION["userTYPE"] == "t") {
    $loginusertype = "教師/teacher";
}else{
    $loginusertype = "生徒/student";
}
?>

<?php include '../globalcommon.php' ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン成功</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php include '../header.php' ?>
<div class="center">
<h1>メイン画面</h1>
<div>ようこそ<?php echo htmlspecialchars($_SESSION["userNAME"], ENT_QUOTES); ?>さん<br>
     ユーザータイプ：<?php echo $loginusertype ?>
</div>

<a href="./pagelogout.php">ログアウト</a></li>
</div>
<?php include '../footer.php' ?>
</body>
</html>