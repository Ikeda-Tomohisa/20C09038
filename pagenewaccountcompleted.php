<!-- page new account completed -->

<?php
session_start();

if ($_SESSION["usertype"] == "t") {
    $realusertype = "教師/teacher";
}else{
    $realusertype = "生徒/student";
}

session_regenerate_id(true);
$_SESSION["userID"] = $_SESSION['userid'];
$_SESSION["userNAME"] = $_SESSION['username'];
$_SESSION["userTYPE"] = $_SESSION['usertype'];
$_SESSION["passWORD"] = $_SESSION['userpass'];
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-アカウント新規登録完了</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
	<h1>アカウント新規登録-完了<span>New account registration completed</span></h1>
	<div>こちらの情報で登録しました<br>
	     Registered with this information
	</div><br>
	<div>あなたのuserIDは<b><?php echo $_SESSION["userid"] ?></b>です。<br>
	     (ログインに使いますので忘れないでください。ユーザーアカウント設定で確認できます。)<br>
	     Your userID is <b><?php echo $_SESSION["userid"] ?></b>. <br>
	     (Don't forget to use it for login. You can check it in the user account settings.)
	</div><br>
	<div class="bigbold"><?php echo "UserID:",$_SESSION["userid"] ?></div>
	<?php echo "Usertype:",$realusertype ?><br>
	<?php echo "Username:",$_SESSION["username"] ?><br>
	<div class="bigbold"><?php echo "Password:",$_SESSION["userpass"] ?></div><br><br>
	<button class="registration" onclick="location.href='./pagemyhome.php'">マイホームへ<br>to myhome</button>
</div>
<?php include './footer.php' ?>
</body>

</html>
