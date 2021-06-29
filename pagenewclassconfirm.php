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

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";

$errorMessage = "";

if(isset($_POST["newclassconfirmed"])) {
    if (!empty($_SESSION["classname"]) && !empty($_SESSION["classid"])) {
        //teacherのstudentidは0とする。
        $classname = $_SESSION["classname"];
        $classid = $_SESSION["classid"];
        $studentid = 0;
        $userid = $_SESSION["userID"];

        try{

        $dbh = new PDO($dsn, $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
        $stmt = $dbh->prepare("INSERT INTO class(classid, classname) VALUES (:classid, :classname)");
        $stmt->bindValue(':classid', $classid, PDO::PARAM_STR);
        $stmt->bindValue(':classname', $classname, PDO::PARAM_STR);
        $stmt->execute();
        
        $stmt2 = $dbh->prepare("UPDATE user SET classid = :classid, studentid = :studentid WHERE userid = :userid");
        $stmt2->bindValue(':classid', $classid, PDO::PARAM_STR);
        $stmt2->bindValue(':studentid', $studentid, PDO::PARAM_INT);
        $stmt2->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt2->execute();
        
        header("Location: ./pagenewclasscompleted.php");
        exit();
        
        $dbh = null;
        }catch(Exception $e){
            $errorMessage = 'データベースエラー';
            //echo $e->getMessage();
            die();
        }
    }
}else if(isset($_POST["back"])) {
    header("Location: ./pagenewclass.php");
    exit();
}
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-クラス新規作成-確認</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
	<h1>クラス新規作成-確認<span>Confirm new class creation</span></h1>
		<div>こちらの情報で間違いありませんか。<br>
		     Is this information correct?
		</div><br>
		<?php echo "Classname:",$_SESSION["classname"] ?><br>
		<?php echo "ClassID:",$_SESSION["classid"] ?><br>
		<?php echo "Teacher's name:",$_SESSION["userNAME"] ?><br><br>
	<form action="" method="post">
		<button type="submit" class="registration" name="back">戻る<br>Back to previous page</button>
		<button type="submit" class="registration" name="newclassconfirmed">登録！<br>Register this information!</button>
	</form>
</div>
<?php include './footer.php' ?>
</body>

</html>
