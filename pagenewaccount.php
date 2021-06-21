<!-- make account pagenewaccount -->

<?php

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";

$errorMessage = "";

if(isset($_POST["signup"])) {
	if (empty($_POST["username"])) {
        $errorMessage = 'ユーザーネームが未入力です。';
    } else if (empty($_POST["userpass"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["userpass2"])) {
        $errorMessage = 'パスワード(確認用)が未入力です。';
    }
    
    if (!empty($_POST["username"]) && !empty($_POST["userpass"]) && !empty($_POST["userpass2"]) && $_POST["userpass"] === $_POST["userpass2"]) {
        // 入力したユーザIDとパスワードを格納
        $username = $_POST["username"];
        //$userpass = $_POST["userpass"];
        $userpass_hash = password_hash($_POST["userpass"], PASSWORD_DEFAULT);

        try{

        $dbh = new PDO($dsn, $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$pdh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
        $stmt = $dbh->prepare("INSERT INTO users(username, password) VALUES (:username, :userpass)");
        
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':userpass', $userpass_hash, PDO::PARAM_STR);
        
        $stmt->execute();
        
        header("Location: ./pagemyhome.php");  // メイン画面へ遷移
        exit();  // 処理終了
        }catch(Exception $e){
            $errorMessage = 'データベースエラー';
            //echo $e->getMessage();
            die();
        }
    }else if(!empty($_POST["userpass2"]) && $_POST["userpass"] != $_POST["userpass2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
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
	<h1>アカウント新規登録</h1>
	<div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
	<form action="" method="post">
	    <label for="username">&ensp;&emsp;&emsp;&emsp;&nbsp;Username:</label>
		<input type="text" class="textbox1" name="username" placeholder="ユーザー名を入力"><br>
		<label for="pass">&ensp;&emsp;&emsp;&emsp;&nbsp;&nbsp;Password:</label>
		<input type="password" class="textbox2" name="userpass" placeholder="パスワードを入力"><br>
		<label for="pass">Confirm Password:</label>
		<input type="password" class="textbox2" name="userpass2" placeholder="パスワードを入力(確認用)"><br><br>
		<input type="submit" class="registration" name="signup" value="新規登録">
	</form>
</div>
<?php include './footer.php' ?>
</body>

</html>
