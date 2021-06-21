<!-- pageclassjoinedconfirm -->

<?php
session_start();
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-クラス確認</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
	<h1>クラス確認</h1>
	ClassID
	<?php
	echo $_SESSION['classid'];
	?><br>
	に参加してます。 
</div>

<?php include './footer.php' ?>

</body>
</html>