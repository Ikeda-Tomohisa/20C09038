<!-- page home work -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-宿題選び</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>どの宿題？</h1>

<span class="rightspace"><button class="subject">国語</button></span>
<button class="subject" onclick="location.href='./howomath.php'">算数</button><br><br>
<span class="rightspace"><button class="subject">理科</button></span>
<button class="subject">社会</button><br><br>
<button class="subject">英語</button>

<br><br>※現在は算数のみ

</div>
<?php include './footer.php' ?>

</body>
</html>