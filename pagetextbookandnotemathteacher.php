<!-- page textbook and note math -->
<?php
session_start();
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-教科書とノート</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>数学-教科書とノート<span>mathematics-textbook and note</span></h1>

<a href="./math.php">教科書とノートを表示</a><br><br>
<a href="./pagenotemathteacher.php">ノートの一覧</a><br><br>
<a href="./pageaddtextbookmath.php">数学の教科書を追加</a><br><br>

<button class="registration" onclick="location.href='./pagesubjectmath.php'">戻る<br>Back to previous page</button><br>

<br><br>※現在は算数のみ

</div>
<?php include './footer.php' ?>
</body>
</html>