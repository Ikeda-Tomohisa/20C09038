<!-- make account pagenewaccount -->

<?php
session_start();

/* csrf対策ができない？
if (!isset($_SESSION['token']) ||
    !isset($_POST['token']) ||
    $_POST['token'] !== $_SESSION['token']){
    var_dump($_POST['token']);
    var_dump($_SESSION['token']);
	echo "不正アクセスの可能性あり";
	exit();
}
*/

if ($_SESSION["usertype"] == "t") {
    $temporaryusertype = "教師/teacher";
}else{
    $temporaryusertype = "生徒/student";
}

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";

$errorMessage = "";

if(isset($_POST["newaccountconfirmed"])) {
    if (!empty($_SESSION["usertype"]) && !empty($_SESSION["username"]) && !empty($_SESSION["userpass"])) {
        // 入力したユーザIDとパスワードを格納
        $usertype = $_SESSION["usertype"];
        $username = $_SESSION["username"];
        $userpass = $_SESSION["userpass"];
        $userpass_hash = password_hash($userpass, PASSWORD_DEFAULT);

        try{

        $dbh = new PDO($dsn, $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$pdh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
        $stmt = $dbh->prepare("INSERT INTO user(usertype, username, password) VALUES (:usertype, :username, :userpass)");
        
        $stmt->bindValue(':usertype', $usertype, PDO::PARAM_STR);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':userpass', $userpass_hash, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $_SESSION["userid"] = $dbh->lastInsertId();
        
        header("Location: ./pagenewaccount3.php");
        exit();
        
        }catch(Exception $e){
            $errorMessage = 'データベースエラー';
            //echo $e->getMessage();
            die();
        }
    }
}else if(isset($_POST["back"])) {
    header("Location: ./pagenewaccount.php");
    exit();
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
	<h1>アカウント新規登録-確認<span>Confirm nre account registration</span></h1>
		<div>こちらの情報で間違いありませんか。<br>
		     Is this information correct?
		</div><br>
		<?php echo "Usertype:",$temporaryusertype ?><br>
		<?php echo "Username:",$_SESSION["username"] ?><br>
		<?php echo "Password:",$_SESSION["userpass"] ?><br><br>
	<form action="" method="post">
		<input type="submit" class="registration" name="back" value="戻る">
		<input type="submit" class="registration" name="newaccountconfirmed" value="登録！">
	</form>
</div>
<?php include '../footer.php' ?>
</body>

</html>
