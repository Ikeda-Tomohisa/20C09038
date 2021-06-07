<!-- pageclassjoin -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-クラス参加</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div id="center">
	<h1>クラス参加</h1>
	<form action="./pageclassjoined.php" method="post">
		<label for="cid">ClassID:</label>
		<input type="id" name="cid" placeholder="ClassID"><br><br>
		<input type="submit" value="参加！">
	</form>
</div>
<?php include './footer.php' ?>

</body>

</html>