<!-- page user_class_settings -->
<?php
session_start();
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-ユーザーアカウント設定</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>ユーザーアカウント設定<span>user account settings</span></h1>
<a href="./pageyouraccount.php">あなたのユーザーアカウント</a><br><br>
<a href="./pageclass.php">クラス作成/参加/確認</a><br><br>
<?php if($_SESSION["userTYPE"] == "t") : ?> 
<a href="./pagehelpteacher.php">ヘルプ（先生用）</a>
<?php elseif($_SESSION["userTYPE"] == "s") : ?>
<a href="./pagehelpstudent.php">ヘルプ（生徒用）</a>
<?php endif; ?><br><br>

<button class="registration" onclick="location.href='./pagemyhome.php'">戻る<br>Back to previous page</button><br><br>


</div>
<?php include './footer.php' ?>

</body>

</html>