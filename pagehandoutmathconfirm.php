<!-- page handout math confirm teacher-->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$classid = $_SESSION["classID"];
$studentid = 0;
$subject = "math";

$errorMessage = "";
$errorMessageEnglish = "";

try {
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $dbh->prepare('SELECT DISTINCT studentid FROM images WHERE classid = :classid AND subject = :subject AND NOT(studentid = :studentid)');
    $stmt->bindValue(':classid', $classid, PDO::PARAM_STR);
    $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
    $stmt->bindValue(':studentid', $studentid, PDO::PARAM_INT);
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $errorMessage = 'データベースエラー';
    $errorMessageEnglish = "Database Error";
    //echo $e->getMessage();
}
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-プリントを確認する</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>
<div class="center">
    <h1>数学-生徒のプリントを確認する<span>confirm student's mathematics-handout</span></h1>
    <?php
    for($i = 0; $i < count($result); $i++) {
        print '<a href="class_'.$classid.'/handoutmathstudentid/'.$result[$i]["studentid"].'.php">'.$result[$i]["studentid"].'</a><br><br>';
        
        if(!file_exists("class_".$classid."/handoutmathstudentid")){
            mkdir("class_".$classid."/handoutmathstudentid");
        }
        if(!file_exists("class_".$classid."/handoutmathstudentid/".$result[$i]["studentid"].".php")){
            file_put_contents("class_".$classid."/handoutmathstudentid/".$result[$i]["studentid"].".php","<?php $"."studentid = ".$result[$i]["studentid"]."; ?>".PHP_EOL);
            file_put_contents("class_".$classid."/handoutmathstudentid/".$result[$i]["studentid"].".php","<?php include '../../studentid.php' ?>",FILE_APPEND);
        }
    }
    ?>
</div>
<?php include './footer.php' ?>
</body>
</html>
