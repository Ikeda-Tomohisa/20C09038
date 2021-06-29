<!-- page new class completed -->

<?php
session_start();
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-クラス新規作成完了</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
	<h1>クラス新規作成-完了<span>New account creation completed</span></h1>
	<div>こちらの情報で登録しました<br>
	     Registered with this information<br>
	     ユーザーアカウント設定で確認できます。<br>
	     You can check it in the user account settings.
	</div><br>
	<?php echo "ClassID:",$_SESSION["classid"] ?><br>
	<?php echo "Classname:",$_SESSION["classname"] ?><br><br>
	<button class="registration" onclick="location.href='./pagemyhome.php'">マイホームへ<br>to myhome</button>
</div>
<?php include './footer.php' ?>
</body>

</html>
