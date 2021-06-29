<!--page class -->

<?php
session_start();
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-クラス</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>クラス<span>class</span></h1>

<?php if($_SESSION["userTYPE"] == "t") : ?> 
<a href="./pagenewclass.php">クラス作成</a>
<?php elseif($_SESSION["userTYPE"] == "s") : ?>
<a href="./pageclassjoin.php">クラス参加</a>
<?php endif; ?><br><br>
<a href="./pageclassjoinedconfirm.php">クラス確認</a><br><br>
<button class="registration" onclick="location.href='./pageuser_class_settings.php'">戻る<br>Back to previous page</button><br><br>



</div>
<?php include './footer.php' ?>

</body>
</html>