<!-- pageyouraccount -->
<?php
session_start();

if ($_SESSION["userTYPE"] == "t") {
    $yourusertype = "教師/teacher";
}else{
    $yourusertype = "生徒/student";
}
?>


<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-あなたのユーザーアカウント</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
<h1>あなたのユーザーアカウント<span>Your user account</span></h1>
<?php echo "userID:",$_SESSION["userID"] ?><br><br>
<?php echo "username:",$_SESSION["userNAME"] ?><br><br>
<?php echo "usertype:",$yourusertype ?><br><br>
<?php echo "password:",$_SESSION["passWORD"] ?>

</div>
<?php include './footer.php' ?>

</body>

</html>