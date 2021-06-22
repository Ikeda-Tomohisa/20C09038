<!-- index pagelogin -->
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
            $stmt = $dbh->prepare('SELECT * FROM user WHERE userid = :userid');
            $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
            $stmt->execute();
            $userpass = $_POST["userpass"];
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($userpass, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['userid'];
                    $sql = "SELECT * FROM users WHERE userid = $id";  //入力したIDからユーザー名を取得
                    $stmt = $dbh->query($sql);
                    foreach ($stmt as $row) {
                        $_SESSION["userID"] = $row['userid'];
                        $_SESSION["userNAME"] = $row['username'];
                        $_SESSION["userTYPE"] = $row['usertype'];
                    }
                    $_SESSION["passWORD"] = $_POST['userpass'];
                    header("Location: ./pagemyhome.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDまたはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDまたはパスワードに誤りがあります。';
            }
            
            $dbh = null;
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            $e->getMessage();
            echo $e->getMessage();
        }
        $dbh = null;
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
