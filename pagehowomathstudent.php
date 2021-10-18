<!-- page homework math student -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-宿題</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>数学-宿題<span>mathematics-homework</span></h1>

<a href="./pagegethowomath.php">宿題をもらう</a><br><br>
<a href="./pagesubmithowomath.php">宿題を提出</a><br><br>
<a href="./pagehowomathconfirmstudent.php">自分の宿題を確認する</a><br><br>
<button class="registration" onclick="location.href='./pagesubjectmath.php'">戻る<br>Back to previous page</button><br>

</div>
<?php include './footer.php' ?>
</body>
</html>