<!-- create account page new account -->

<?php
session_start();

//クリックジャッキング対策
header("X-FRAME-OPTIONS: SAMEORIGIN");

//csrf対策ができない？
//$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
//$token = $_SESSION['token'];

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";

$errorMessage = "";
$errorMessageEnglish = "";
if(isset($_POST["newaccountconfirm"])) {
    $errorMessage = "";
    $errorMessageEnglish = "";
    if (empty($_POST["usertype"])) {
        $errorMessage = "ユーザータイプが未入力です。";
        $errorMessageEnglish = "Usertype is not entered.";
    } else if (empty($_POST["userid"]) || empty($_POST["username"]) || empty($_POST["userpass"]) || empty($_POST["userpass2"])) {
        $errorMessage = "ユーザーIDまたはユーザー名またはパスワードが未入力です。";
        $errorMessageEnglish = "UserID or username or password is not entered.";
    } else if (mb_strlen($_POST["userid"]) < 6) {
        $errorMessage = "ユーザーIDは6文字以上にしてください。";
        $errorMessageEnglish = "Password should be at least 8 characters.";
    } else if (mb_strlen($_POST["userpass"]) < 8) {
        $errorMessage = "パスワードは8文字以上にしてください。";
        $errorMessageEnglish = "Password should be at least 8 characters.";
    } else if (!preg_match( "/\A[a-z\d]{6,255}+\z/i" , $_POST["userpass"])) {
        $errorMessage = "ユーザーIDは半角英数字にしてください。";
        $errorMessageEnglish = "Password should be a single-byte alphanumeric characters.";
    } else if (!preg_match( "/\A[a-z\d]{8,255}+\z/i" , $_POST["userpass"])) {
        $errorMessage = "パスワードは半角英数字にしてください。";
        $errorMessageEnglish = "Password should be a single-byte alphanumeric characters.";
    }
    
    if (!empty($_POST["username"]) && !empty($_POST["userpass"]) && !empty($_POST["userpass2"]) && $_POST["userpass"] === $_POST["userpass2"] && $errorMessage == "") {
        $userid = $_POST["userid"];
        try{
            $dbh = new PDO($dsn, $dbuser, $dbpass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            $stmt = $dbh->prepare("SELECT * FROM users WHERE userid = :userid");
            $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result > 0) {
                $errorMessage = "このユーザーIDは既に存在しています。";
                $errorMessageEnglish = "This userID already exists.";
            } else {
                $_SESSION["usertype"] = $_POST["usertype"];
                $_SESSION["userid"] = $_POST["userid"];
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["userpass"] = $_POST["userpass"];
                
                header("Location: ./pagenewaccountconfirm.php");
                exit();
                
                $dbh = null;
            }
        }catch(Exception $e){
            $errorMessage = 'データベースエラー';
            $errorMessageEnglish = "Database Error";
            //echo $e->getMessage();
        }
    }else if(!empty($_POST["userpass2"]) && $_POST["userpass"] != $_POST["userpass2"]) {
        $errorMessage = 'ユーザーIDまたはパスワードに誤りがあります。';
        $errorMessageEnglish = 'The userID or password is incorrect.';
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
	ユーザーIDは半角英数字・6文字以上で入力してください。<br>
	Please enter the userID using 6 or more single-byte alphanumeric characters.<br>
	パスワードは半角英数字・8文字以上で入力してください。<br>
	Please enter the password using 8 or more single-byte alphanumeric characters.
	</div>
	<form action="" method="post">
		<label for="usertype">&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Usertype:</label>
		<input type="radio" class="margintop10" name="usertype" value="t">
		<label for="t">教師/teacher</label>
		<input type="radio" class="margintop10" name="usertype" value="s">
		<label for="s">生徒/student</label><br>
		<label for="userid">&ensp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&thinsp;UserID:</label>
		<input type="text" class="textbox2" name="userid" placeholder="ユーザーIDを入力"><br>
	    <label for="username">&ensp;&emsp;&emsp;&emsp;&nbsp;Username:</label>
		<input type="text" class="textbox2" name="username" placeholder="ユーザー名を入力"><br>
		<label for="pass">&ensp;&emsp;&emsp;&emsp;&nbsp;&nbsp;Password:</label>
		<input type="password" class="textbox2" name="userpass" placeholder="パスワードを入力"><br>
		<label for="pass">Confirm Password:</label>
		<input type="password" class="textbox2" name="userpass2" placeholder="パスワードを入力(確認用)"><br><br>
		<button type="submit" class="registration" name="newaccountconfirm">確認画面へ<br>To confirmation screen</button>
		<!-- <input type="hidden" name="token" value="<?=$token?>"> -->
	</form>
</div>
<?php include './footer.php' ?>
</body>

</html>
