<!-- index pagelogin -->

<?php include './globalcommon.php' ?>
<?php
session_start();
$message = '';
$user = 'hoge';
$password = 'hogehoge';
if(isset($_POST['login'])){
    if ($_POST['user'] == $user && $_POST['password'] == $password){
        $_SESSION["LOGIN"] = 'ON';
        header("Location: pagemyhome.php"); //ログイン後のページにリダイレクト
        exit();
        //$message = 'ログインしました。';
    }
    else{
        $message = 'ユーザー名かパスワードが間違っています。';
    }
}
/*
if( !empty( $_SESSION['LOGIN'] ) && $_SESSION['LOGIN'] == "ON" ):
$message = 'ログインしています。';
endif;
if(isset($_POST['logout'])){
    if( !empty( $_SESSION['LOGIN'] ) && $_SESSION['LOGIN'] == "ON" ):
        session_destroy();
		session_start();
        $message = 'ログアウトしました。';
    endif;
}
*/
?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-ログインページ</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>
<div id="right"><a href="pagenewaccount.php">新しいアカウント作成</a></div>
<div id="center">
	<h1>ログイン</h1>
	<form action="./index2.php" method="post">
		<label for="uid">&thinsp;&emsp;UserID:</label>
		<input type="id" name="uid" placeholder="UserID"><br>
		<label for="pass">Password:</label>
		<input type="password" name="pass" placeholder="Password"><br><br>
		<input type="submit" value="ログイン">
	</form>
	<p style="color: red;"><?php echo $message; ?></p>
</div>
<?php include './footer.php' ?>
</body>

</html>