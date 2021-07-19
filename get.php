<!-- get -->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$classid = $_SESSION["classID"];
$studentid = 0;
$errorMessage = "";
$errorMessageEnglish = "";

try {
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $dbh->prepare('SELECT filename FROM images WHERE classid = :classid AND date = :date AND studentid = :studentid');
    $stmt->bindValue(':classid', $classid, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':studentid', $studentid, PDO::PARAM_INT);
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<title>myapp-数学-プリントをもらう</title>
<link rel="stylesheet" href="../../css/style.css">
</head>

<body>
<?php include '../../header.php' ?>
<div class="center">
    <h1>数学-プリントをもらう<span>get mathematics-handout</span></h1>
    <?php
    for($i = 0; $i < count($result); $i++) {
        
        if (!file_exists("../handoutmathfiles_student")) {
            mkdir("../handoutmathfiles_student");
        }
        if (!file_exists("../handoutmathfiles_student/".$date)) {
            mkdir("../handoutmathfiles_student/".$date);
        }
        if (strpos($result[$i]["filename"], ".png") !== false) {
            $file = $result[$i]["filename"];
            $files = str_replace(".png", "", $result[$i]["filename"]);
            print '<a href="'.'../handoutmathfiles_student/'.$date.'/'.$files.'_get.php">'.$files.'</a><br><br>';
            
            if (!file_exists("../handoutmathfiles_student/".$date.'/'.$files."_get.php")) {
                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files."_get.php","<?php $"."file=\"".$file."\";".PHP_EOL);
                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files."_get.php","$"."date=\"".$date."\"; ?>".PHP_EOL,FILE_APPEND);
                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files."_get.php","<?php include '../../../download.php' ?>",FILE_APPEND);
            }
            
        } else if (strpos($result[$i]["filename"], ".jpg") !== false){
            $file = $result[$i]["filename"];
            $files = str_replace(".jpg", "", $result[$i]["filename"]);
            print '<a href="'.'../handoutmathfiles_student/'.$date.'/'.$files.'_get.php">'.$files.'</a><br><br>';
            
            if (!file_exists("../handoutmathfiles_student/".$date.'/'.$files."_get.php")) {
                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files."_get.php","<?php $"."file=\"".$file."\";".PHP_EOL);
                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files."_get.php","$"."date=\"".$date."\"; ?>".PHP_EOL,FILE_APPEND);
                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files."_get.php","<?php include '../../../download.php' ?>",FILE_APPEND);
            }
            
        } else if (strpos($result[$i]["filename"], ".jpeg") !== false){
            $file = $result[$i]["filename"];
            $files = str_replace(".jpeg", "", $result[$i]["filename"]);
            print '<a href="'.'../handoutmathfiles_student/'.$date.'/'.$files.'_get.php">'.$files.'</a><br><br>';
            
            if (!file_exists("../handoutmathfiles_student/".$date.'/'.$files."_get.php")) {
                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files."_get.php","<?php $"."file=\"".$file."\";".PHP_EOL);
                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files."_get.php","$"."date=\"".$date."\"; ?>".PHP_EOL,FILE_APPEND);
                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files."_get.php","<?php include '../../../download.php' ?>",FILE_APPEND);
            }
        }
    }
    ?>
</div>
<?php include '../../footer.php' ?>
</body>
</html>
