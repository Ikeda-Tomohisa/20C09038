<!-- page homework math confirm teacher-->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$classid = $_SESSION["classID"];
$subject = "math";
$studentid = $_SESSION["studentID"];
$imagetype = "homework";

$errorMessage = "";
$errorMessageEnglish = "";

try {
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $dbh->prepare('SELECT DISTINCT date FROM images WHERE subject = :subject AND imagetype = :imagetype AND classid = :classid AND studentid = :studentid');
    $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
    $stmt->bindValue(':imagetype', $imagetype, PDO::PARAM_STR);
    $stmt->bindValue(':classid', $classid, PDO::PARAM_STR);
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
<title>myapp-数学-宿題を確認する</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>
<div class="center">
    <h1>数学-宿題を確認する<span>confirm mathematics-homework</span></h1>
    <?php
    for($i = 0; $i < count($result); $i++) {
        print '<a href="class_'.$classid.'/howomathdates_student/'.$result[$i]["date"].'.php">'.$result[$i]["date"].'</a><br><br>';
        
        if(!file_exists("class_".$classid."/howomathdates_student")){
            mkdir("class_".$classid."/howomathdates_student");
        }
        if(!file_exists("class_".$classid."/howomathdates_student/".$result[$i]["date"].".php")){
            file_put_contents("class_".$classid."/howomathdates_student/".$result[$i]["date"].".php","<?php $"."date = \"".$result[$i]["date"]."\"; ?>".PHP_EOL);
            file_put_contents("class_".$classid."/howomathdates_student/".$result[$i]["date"].".php","<?php $"."imagetype = \"".$imagetype."\"; ?>".PHP_EOL, FILE_APPEND);
            file_put_contents("class_".$classid."/howomathdates_student/".$result[$i]["date"].".php","<?php include '../../dates2.php' ?>", FILE_APPEND);
        }
    }
    ?>
</div>
<?php include './footer.php' ?>
</body>
</html>
