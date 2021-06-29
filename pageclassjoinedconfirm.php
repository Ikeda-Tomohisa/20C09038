<!-- page class joined confirm -->

<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$userid = $_SESSION["userID"];

$attention = "";
$attentionEnglish = "";

try {
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $dbh->prepare('SELECT * FROM user WHERE userid = :userid');
    $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $classid = $row['classid'];
    $studentid = $row['studentid'];
    
    $stmt2 = $dbh->prepare('SELECT * FROM class WHERE classid = :classid');
    $stmt2->bindValue(':classid', $classid, PDO::PARAM_STR);
    $stmt2->execute();
    
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($row2 == False) {
        $classname = "";
    } else {
        $classname = $row2['classname'];
    }
    if ($studentid == 0) {
        $studentid = "class-teacher";
    }
    if (is_null($classid)) {
        $classid = "";
        $studentid = "";
        $classname = "";
        $attention = "クラスに参加していません。";
        $attentionEnglish = "NOT participate in the class.";
    }
} catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    //$e->getMessage();
    //echo $e->getMessage();
}
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-クラス確認</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
	<h1>クラス確認<span>class confirm</span></h1>
	<?php if($classid != "") : ?>
	<div>このクラスに参加しています。<br>
	     participating in this class.
	</div><br>
	<?php endif; ?>
	<div class="red"><?php echo htmlspecialchars($attention, ENT_QUOTES); ?></div>
    <div class="red"><?php echo htmlspecialchars($attentionEnglish, ENT_QUOTES); ?></div>

	<?php echo "ClassID:",$classid ?><br><br>
	<?php echo "Classname:",$classname ?><br><br>
	<?php echo "StudentID:",$studentid ?><br><br>
	
	<button class="registration" onclick="location.href='./pageclass.php'">戻る<br>Back to previous page</button><br><br>

</div>

<?php include './footer.php' ?>

</body>
</html>