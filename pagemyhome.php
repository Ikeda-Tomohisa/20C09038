<!-- home pagemyhome -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-マイホーム</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<!--
Welcome <?php echo $_POST["uid"]; ?><br>
Your password is: <?php echo $_POST["pass"]; ?><br>
-->

<div id="right"><a href="./index.php">ログアウト</a></div>
<div id="center">
<h1>マイホーム</h1>
<a href="./pagetextbookchoice.php">教科書とノート</a><br><br>
<a href="./pagehomework.php">宿題</a><br><br>
<a href="./pageclassjoin.php">クラス参加</a><br><br>
<a href="./pageclassjoinedconfirm.php">クラス確認</a>
</div>
<?php include './footer.php' ?>

</body>
</html>