<!-- dates -->
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
    $stmt = $dbh->prepare('SELECT filename FROM images WHERE classid = :classid AND date = :date');
    $stmt->bindValue(':classid', $classid, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $errorMessage = 'データベースエラー';
    $errorMessageEnglish = "Database Error";
    //echo $e->getMessage();
}
?>

<?php include '../../globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-プリントを確認する</title>
<link rel="stylesheet" href="../../css/style.css">
</head>

<body>
<?php include '../../header.php' ?>

<div class="center">
    <h1>数学-プリントを確認する<span>give mathematics-handout</span></h1>
    <?php
    foreach ($result as $files) {
        print '<a href="class_'.$classid.'/handoutmathfiles/'.$files.'.php">'.$files.'</a><br><br>';
        
        if (!file_exists("class_".$classid."/handoutmathfiles")) {
            mkdir("class_".$classid."/handoutmathfiles");
        }
        if (strpos($files, ".png") !== false) {
            $files = str_replace(".png", "", $files);
            if (!file_exists("class_".$classid."/handoutmathfiles/".$files.".php")) {
                file_put_contents("class_".$classid."/handoutmathfiles/".$files.".php","<?php $"."data = file_get_contents(../handoutmath/".$files.");".PHP_EOL);
                file_put_contents("class_".$classid."/handoutmathfiles/".$files.".php","header('Content-type: image/png');".PHP_EOL,FILE_APPEND);
                file_put_contents("class_".$classid."/handoutmathfiles/".$files.".php","echo $"."data; ?>",FILE_APPEND);
            }
        } else {
            $files = str_replace(".jpg", "", $files);
            $files = str_replace(".jpeg", "", $files);
            if (!file_exists("class_".$classid."/handoutmathfiles/".$files.".php")) {
                file_put_contents("class_".$classid."/handoutmathfiles/".$files.".php","<?php $"."data = file_get_contents(../handoutmath/".$files.");".PHP_EOL);
                file_put_contents("class_".$classid."/handoutmathfiles/".$files.".php","header('Content-type: image/jpg');".PHP_EOL,FILE_APPEND);
                file_put_contents("class_".$classid."/handoutmathfiles/".$files.".php","echo $"."data; ?>",FILE_APPEND);
            }
        }
    }
    ?>
</div>
<?php include '../../footer.php' ?>
</body>
</html>
