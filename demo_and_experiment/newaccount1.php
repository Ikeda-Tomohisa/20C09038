<!-- make account pagenewaccount -->

<?php
session_start();

//クリックジャッキング対策
header("X-FRAME-OPTIONS: DENY");

//csrf対策ができない？
//$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
//$token = $_SESSION['token'];

$errorMessage = "";
if(isset($_POST["newaccountconfirm"])) {
    $errorMessage = "";
	if (empty($_POST["username"]) || empty($_POST["userpass"]) || empty($_POST["userpass2"])) {
        $errorMessage = 'ユーザーIDまたはパスワードが未入力です。';
    } else if (mb_strlen($_POST["userpass"]) < 8) {
        $errorMessage = 'パスワードは8文字以上にしてください。';
    } else if (!preg_match( "/\A[a-z\d]{8,100}+\z/i" , $_POST["userpass"])) {
        $errorMessage = 'パスワードは半角英数字にしてください。';
    }
    
    if (!empty($_POST["username"]) && !empty($_POST["userpass"]) && !empty($_POST["userpass2"]) && $_POST["userpass"] === $_POST["userpass2"] && $errorMessage == "") {
        // 入力したユーザIDとパスワードを格納
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["userpass"] = $_POST["userpass"];
        
        header("Location: ./newaccount2.php");
        exit();
    }else if(!empty($_POST["userpass2"]) && $_POST["userpass"] != $_POST["userpass2"]) {
        $errorMessage = 'ユーザーIDまたはパスワードに誤りがあります。';
    } 
}
?>

<?php include '../globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-アカウント新規登録</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php include '../header.php' ?>

<div class="center">
	<h1>アカウント新規登録</h1>
	<div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
	<div>パスワードは半角英数字・8文字以上で入力してください。</div>
	<form action="" method="post">
	    <label for="username">&ensp;&emsp;&emsp;&emsp;&nbsp;Username:</label>
		<input type="text" class="textbox2" name="username" placeholder="ユーザー名を入力"><br>
		<label for="pass">&ensp;&emsp;&emsp;&emsp;&nbsp;&nbsp;Password:</label>
		<input type="password" class="textbox2" name="userpass" placeholder="パスワードを入力"><br>
		<label for="pass">Confirm Password:</label>
		<input type="password" class="textbox2" name="userpass2" placeholder="パスワードを入力(確認用)"><br><br>
		<input type="submit" class="registration" name="newaccountconfirm" value="確認画面へ">
		<!-- <input type="hidden" name="token" value="<?=$token?>"> -->
	</form>
</div>
<?php include '../footer.php' ?>
</body>

</html>
