<!-- page handout math confirm teacher-->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$classid = $_SESSION["classID"];

$errorMessage = "";
$errorMessageEnglish = "";

try {
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $dbh->prepare('SELECT date FROM images WHERE classid = :classid');
    $stmt->bindValue(':classid', $classid, PDO::PARAM_STR);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <h1>数学-プリントを確認する<span>give mathematics-handout</span></h1>
    <?php
    foreach ($result as $dates) {
        print '<a href="class_'.$classid.'/handoutmathdates/'.$dates.'.php">'.$dates.'</a><br><br>';
        
        if(!file_exists("class_".$classid."/handoutmathdates")){
            mkdir("class_".$classid."/handoutmathdates");
        }
        if(!file_exists("class_".$classid."/handoutmathdates/".$dates.".php")){
            file_put_contents("class_".$classid."/handoutmathdates/".$dates.".php","<?php $"."date = \"".$dates."\"; ?>".PHP_EOL);
            file_put_contents("class_".$classid."/handoutmathdates/".$dates.".php","<?php include '../../dates.php' ?>",FILE_APPEND);
        }
    }
    ?>
</div>
<?php include './footer.php' ?>
</body>
</html>
