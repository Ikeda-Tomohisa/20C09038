<!-- page subject choice -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-教科書選び</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>どの教科？<span>which subject?</span></h1>

<div class="rightspace"><button class="subject">国語<br>Japanese</button>
<button class="subject" onclick="location.href='./pagesubjectmath.php'">算数<br>Mathematics</button></div><br>
<div class="rightspace"><button class="subject">理科<br>Science</button>
<button class="subject">社会<br>Social studies</button></div><br>
<div class="rightspace"><button class="subject">英語<br>English</button>
</div><br>

<button class="registration" onclick="location.href='./pagemyhome.php'">戻る<br>Back to previous page</button><br>

<br><br>※現在は算数のみ

</div>
<?php include './footer.php' ?>
</body>
</html>