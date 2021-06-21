<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["userNAME"])) {
    header("Location: ./logout.php");
    exit;
}
?>

<?php include '../globalcommon.php' ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>メイン</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php include '../header.php' ?>
<h1>メイン画面</h1>
<!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
<p>ようこそ<?php echo htmlspecialchars($_SESSION["userNAME"], ENT_QUOTES); ?>さん</p>  <!-- ユーザー名をechoで表示 -->
<ul>
    <li><a href="./logout.php">ログアウト</a></li>
</ul>
<?php include '../footer.php' ?>
</body>
</html>