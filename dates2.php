<!-- dates -->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$classid = $_SESSION["classID"];
$studentid = $_SESSION["studentID"];
$errorMessage = "";
$errorMessageEnglish = "";

try {
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $stmt = $dbh->prepare('SELECT filename FROM images WHERE imagetype = :imagetype AND date = :date AND classid = :classid AND studentid = :studentid');
    $stmt->bindValue(':imagetype', $imagetype, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
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
    <h1>数学-プリントを確認する<span>confirm mathematics-handout</span></h1>
    <?php
    for($i = 0; $i < count($result); $i++) {
        if($imagetype == "print") {
	        if (!file_exists("../handoutmathfiles_student")) {
	            mkdir("../handoutmathfiles_student");
	        }
	        if (!file_exists("../handoutmathfiles_student/".$date)) {
	            mkdir("../handoutmathfiles_student/".$date);
	        }
	        if (strpos($result[$i]["filename"], ".png") !== false) {
	            $files = str_replace(".png", "", $result[$i]["filename"]);
	            print '<a href="'.'../handoutmathfiles_student/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../handoutmathfiles_student/".$date.'/'.$files.".php")) {
	                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files.".php","<?php $"."data = file"."_get_contents(\"../../handoutmath_student/".$studentid."/".$date."/".$files.".png\");".PHP_EOL);
	                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files.".php","header('Content-type: image/png');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        } else if (strpos($result[$i]["filename"], ".jpg") !== false){
	            $files = str_replace(".jpg", "", $result[$i]["filename"]);
	            print '<a href="'.'../handoutmathfiles_student/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../handoutmathfiles_student/".$date.'/'.$files.".php")) {
	                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files.".php","<?php $"."data = file_"."get_contents(\"../../handoutmath_student/".$studentid."/".$date."/".$files.".jpg\");".PHP_EOL);
	                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files.".php","header('Content-type: image/jpeg');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        } else if (strpos($result[$i]["filename"], ".jpeg") !== false){
	            $files = str_replace(".jpeg", "", $result[$i]["filename"]);
	            print '<a href="'.'../handoutmathfiles_student/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../handoutmathfiles_student/".$date.'/'.$files.".php")) {
	                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files.".php","<?php $"."data = file_"."get_contents(\"../../handoutmath_student/".$studentid."/".$date."/".$files.".jpeg\");".PHP_EOL);
	                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files.".php","header('Content-type: image/jpeg');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../handoutmathfiles_student/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        }
	    } else if ($imagetype == "homework") {
	        if (!file_exists("../howomathfiles_student")) {
	            mkdir("../howomathfiles_student");
	        }
	        if (!file_exists("../howomathfiles_student/".$date)) {
	            mkdir("../howomathfiles_student/".$date);
	        }
	        if (strpos($result[$i]["filename"], ".png") !== false) {
	            $files = str_replace(".png", "", $result[$i]["filename"]);
	            print '<a href="'.'../howomathfiles_student/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../howomathfiles_student/".$date.'/'.$files.".php")) {
	                file_put_contents("../howomathfiles_student/".$date.'/'.$files.".php","<?php $"."data = file"."_get_contents(\"../../handoutmath_student/".$studentid."/".$date."/".$files.".png\");".PHP_EOL);
	                file_put_contents("../howomathfiles_student/".$date.'/'.$files.".php","header('Content-type: image/png');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../howomathfiles_student/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        } else if (strpos($result[$i]["filename"], ".jpg") !== false){
	            $files = str_replace(".jpg", "", $result[$i]["filename"]);
	            print '<a href="'.'../howomathfiles_student/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../howomathfiles_student/".$date.'/'.$files.".php")) {
	                file_put_contents("../howomathfiles_student/".$date.'/'.$files.".php","<?php $"."data = file_"."get_contents(\"../../handoutmath_student/".$studentid."/".$date."/".$files.".jpg\");".PHP_EOL);
	                file_put_contents("../howomathfiles_student/".$date.'/'.$files.".php","header('Content-type: image/jpeg');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../howomathfiles_student/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        } else if (strpos($result[$i]["filename"], ".jpeg") !== false){
	            $files = str_replace(".jpeg", "", $result[$i]["filename"]);
	            print '<a href="'.'../howomathfiles_student/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../howomathfiles_student/".$date.'/'.$files.".php")) {
	                file_put_contents("../howomathfiles_student/".$date.'/'.$files.".php","<?php $"."data = file_"."get_contents(\"../../handoutmath_student/".$studentid."/".$date."/".$files.".jpeg\");".PHP_EOL);
	                file_put_contents("../howomathfiles_student/".$date.'/'.$files.".php","header('Content-type: image/jpeg');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../howomathfiles_student/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        }
	    }
    }
    ?>
</div>
<?php include '../../footer.php' ?>
</body>
</html>
