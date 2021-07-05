<!-- index page login -->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";

$errorMessage = "";
$errorMessageEnglish = "";
if(isset($_POST["login"])) {
	if (empty($_POST["userid"]) || empty($_POST["userpass"])) {
        $errorMessage = "ユーザーIDまたはパスワードが未入力です。";
        $errorMessageEnglish = "UserID or password is not entered.";
    }
    if (!empty($_POST["userid"]) && !empty($_POST["userpass"])) {
        $userid = $_POST["userid"];
        
        try {
            $dbh = new PDO($dsn, $dbuser, $dbpass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $stmt = $dbh->prepare('SELECT * FROM users WHERE userid = :userid');
            $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
            $stmt->execute();
            $userpass = $_POST["userpass"];
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($userpass, $row['password'])) {
                    session_regenerate_id(true);
                    $_SESSION["userID"] = $row['userid'];
                    $_SESSION["userNAME"] = $row['username'];
                    $_SESSION["userTYPE"] = $row['usertype'];
                    $_SESSION["passWORD"] = $_POST['userpass'];
                    $_SESSION["classID"] = $row['classid'];
                    $_SESSION["studentID"] = $row['studentid'];
                    $_SESSION["studentname"] = $row['studentname'];
                    
                    header("Location: ./pagemyhome.php");
                    exit();
                    $dbh = null;
                } else {
                    $errorMessage = 'ユーザーIDまたはパスワードに誤りがあります。';
                    $errorMessageEnglish = 'The userID or password is incorrect.';
                }
            } else {
                $errorMessage = 'ユーザーIDまたはパスワードに誤りがあります。';
                $errorMessageEnglish = 'The userID or password is incorrect.';
            }
            $dbh = null;
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            $errorMessageEnglish = "Database Error";
            echo $e->getMessage();
        }
    }
}
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-ログインページ</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>
<div class="center">
	<h1>ログイン<span>login</span></h1>
	<div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
	<div class="red"><?php echo htmlspecialchars($errorMessageEnglish, ENT_QUOTES); ?></div>
	<form action="" method="post">
		<label for="userid">&emsp;&nbsp;&thinsp;UserID:</label>
		<input type="text" class="textbox1" name="userid" placeholder="UserID"><br>
		<label for="userpass">&nbsp;Password:</label>
		<input type="password" class="textbox2" name="userpass" placeholder="Password"><br>
		<input type="submit" id="login" name="login" value="ログイン / login">
	</form>
	<br><button class="registration" onclick="location.href='./pagenewaccount.php'">アカウント新規登録<br>初めての方はこちら<br>New account registration</button>
	
</div>
<?php include './footer.php' ?>
</body>

</html>
