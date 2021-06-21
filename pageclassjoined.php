<!-- pageclassjoined -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>マイホーム</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
ClassID <?php echo $_POST["cid"]; ?> <br>
に参加しました！<br>
<?php 
session_start();
$_SESSION['classid']=$_POST["cid"];
?>
<button onclick="location.href='./pagemyhome.php'">ok!</button>
</div>

<?php include './footer.php' ?>
</body>
</html>