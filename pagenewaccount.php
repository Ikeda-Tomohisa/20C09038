<!-- make account pagenewaccount -->

<?php
session_start();

//クリックジャッキング対策
header("X-FRAME-OPTIONS: SAMEORIGIN");

//csrf対策ができない？
//$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
//$token = $_SESSION['token'];

$errorMessage = "";
$errorMessageEnglish = "";
if(isset($_POST["newaccountconfirm"])) {
    $errorMessage = "";
    $errorMessageEnglish = "";
    if (empty($_POST["usertype"])) {
        $errorMessage = "ユーザータイプが未入力です。";
        $errorMessageEnglish = "Usertype is not entered.";
    } else if (empty($_POST["username"]) || empty($_POST["userpass"]) || empty($_POST["userpass2"])) {
        $errorMessage = "ユーザーネームまたはパスワードが未入力です。";
        $errorMessageEnglish = "Username or password is not entered.";
    } else if (mb_strlen($_POST["userpass"]) < 8) {
        $errorMessage = "パスワードは8文字以上にしてください。";
        $errorMessageEnglish = "Password should be at least 8 characters.";
    } else if (!preg_match( "/\A[a-z\d]{8,100}+\z/i" , $_POST["userpass"])) {
        $errorMessage = "パスワードは半角英数字にしてください。";
        $errorMessageEnglish = "Password should be a single-byte alphanumeric characters.";
    }
    
    if (!empty($_POST["username"]) && !empty($_POST["userpass"]) && !empty($_POST["userpass2"]) && $_POST["userpass"] === $_POST["userpass2"] && $errorMessage == "") {
        // 入力したユーザIDとパスワードを格納
        $_SESSION["usertype"] = $_POST["usertype"];
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["userpass"] = $_POST["userpass"];
        
        header("Location: ./pagenewaccountconfirm.php");
        exit();
    }else if(!empty($_POST["userpass2"]) && $_POST["userpass"] != $_POST["userpass2"]) {
        $errorMessage = 'ユーザーIDまたはパスワードに誤りがあります。';
    } 
}
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-アカウント新規登録</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
	<h1>アカウント新規登録<span>New account registration</span></h1>
	<div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
	<div class="red"><?php echo htmlspecialchars($errorMessageEnglish, ENT_QUOTES); ?></div>
	<div>
	パスワードは半角英数字・8文字以上で入力してください。<br>
	Please enter the password using 8 or more single-byte alphanumeric characters.
	</div>
	<form action="" method="post">
		<label for="usertype">&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Usertype:</label>
		<input type="radio" class="margintop20" name="usertype" value="t">
		<label for="t">教師/teacher</label>
		<input type="radio" class="margintop20" name="usertype" value="s">
		<label for="s">生徒/student</label><br>
	    <label for="username">&ensp;&emsp;&emsp;&emsp;&nbsp;Username:</label>
		<input type="text" class="textbox2" name="username" placeholder="ユーザー名を入力"><br>
		<label for="pass">&ensp;&emsp;&emsp;&emsp;&nbsp;&nbsp;Password:</label>
		<input type="password" class="textbox2" name="userpass" placeholder="パスワードを入力"><br>
		<label for="pass">Confirm Password:</label>
		<input type="password" class="textbox2" name="userpass2" placeholder="パスワードを入力(確認用)"><br><br>
		<button type="submit" class="registration" name="newaccountconfirm">確認画面へ<br>To confirmation screen</button>
		<!-- <input type="submit" class="registration" name="newaccountconfirm" value="確認画面へ"> -->
		<!-- <input type="hidden" name="token" value="<?=$token?>"> -->
	</form>
</div>
<?php include './footer.php' ?>
</body>

</html>
