<!-- page subject math -->
<?php
session_start();
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>数学<span>mathematics</span></h1>


<?php if($_SESSION["userTYPE"] == "t") : ?> 
<a href="./pagetextbookandnotemathteacher.php">教科書とノート</a><br><br>
<a href="./pagehowomathteacher.php">宿題（先生用）</a><br><br>
<a href="./pagehandoutmathteacher.php">プリント（先生用）</a><br><br>
<?php elseif($_SESSION["userTYPE"] == "s") : ?>
<a href="./math.php">教科書とノート</a><br><br>
<a href="./pagehowomathstudent.php">宿題（生徒用）</a><br><br>
<a href="./pagehandoutmathstudent.php">プリント（生徒用）</a><br><br>
<?php endif; ?>
<button class="registration" onclick="location.href='./pagesubjectchoice.php'">戻る<br>Back to previous page</button><br>

<br><br>※現在は算数のみ

</div>
<?php include './footer.php' ?>
</body>
</html>