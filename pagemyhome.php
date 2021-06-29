<!-- home page myhome -->

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

<div class="right"><a href="./pagelogout.php">ログアウト / logout</a></div>
<div class="center">
<h1>マイホーム<span>my home</span></h1>
<a href="./pagetextbookchoice.php">教科書とノート</a><br><br>
<a href="./pagehomework.php">宿題</a><br><br>
<a href="./pageuser_class_settings.php">ユーザーアカウント設定</a>
</div>
<?php include './footer.php' ?>

</body>
</html>