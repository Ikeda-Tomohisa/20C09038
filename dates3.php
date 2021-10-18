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
    <?php if($imagetype == "print"): ?>
    <h1>数学-生徒のプリントを確認する<span>confirm student's mathematics-handout</span></h1>
    <?php elseif($imagetype == "homework"): ?>
    <h1>数学-生徒の宿題を確認する<span>confirm student's mathematics-homework</span></h1>
    <?php endif; ?>
    <?php
    for($i = 0; $i < count($result); $i++) {
        if($imagetype == "print"){
	        if (!file_exists("../handoutmathfilesstudentid")) {
	            mkdir("../handoutmathfilesstudentid");
	        }
	        if (!file_exists("../handoutmathfilesstudentid/".$date)) {
	            mkdir("../handoutmathfilesstudentid/".$date);
	        }
	        if (strpos($result[$i]["filename"], ".png") !== false) {
	            $files = str_replace(".png", "", $result[$i]["filename"]);
	            print '<a href="'.'../handoutmathfilesstudentid/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../handoutmathfilesstudentid/".$date.'/'.$files.".php")) {
	                file_put_contents("../handoutmathfilesstudentid/".$date.'/'.$files.".php","<?php $"."data = file"."_get_contents(\"../../handoutmath_student/".$studentid."/".$date."/".$files.".png\");".PHP_EOL);
	                file_put_contents("../handoutmathfilesstudentid/".$date.'/'.$files.".php","header('Content-type: image/png');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../handoutmathfilesstudentid/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        } else if (strpos($result[$i]["filename"], ".jpg") !== false){
	            $files = str_replace(".jpg", "", $result[$i]["filename"]);
	            print '<a href="'.'../handoutmathfilesstudentid/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../handoutmathfilesstudentid/".$date.'/'.$files.".php")) {
	                file_put_contents("../handoutmathfilesstudentid/".$date.'/'.$files.".php","<?php $"."data = file_"."get_contents(\"../../handoutmath_student/".$studentid."/".$date."/".$files.".jpg\");".PHP_EOL);
	                file_put_contents("../handoutmathfilesstudentid/".$date.'/'.$files.".php","header('Content-type: image/jpeg');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../handoutmathfilesstudentid/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        } else if (strpos($result[$i]["filename"], ".jpeg") !== false){
	            $files = str_replace(".jpeg", "", $result[$i]["filename"]);
	            print '<a href="'.'../handoutmathfilesstudentid/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../handoutmathfilesstudentid/".$date.'/'.$files.".php")) {
	                file_put_contents("../handoutmathfilesstudentid/".$date.'/'.$files.".php","<?php $"."data = file_"."get_contents(\"../../handoutmath_student/".$studentid."/".$date."/".$files.".jpeg\");".PHP_EOL);
	                file_put_contents("../handoutmathfilesstudentid/".$date.'/'.$files.".php","header('Content-type: image/jpeg');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../handoutmathfilesstudentid/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        }
	    } else if($imagetype = "homework") {
	        if (!file_exists("../howomathfilesstudentid")) {
	            mkdir("../howomathfilesstudentid");
	        }
	        if (!file_exists("../howomathfilesstudentid/".$date)) {
	            mkdir("../howomathfilesstudentid/".$date);
	        }
	        if (strpos($result[$i]["filename"], ".png") !== false) {
	            $files = str_replace(".png", "", $result[$i]["filename"]);
	            print '<a href="'.'../howomathfilesstudentid/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../howomathfilesstudentid/".$date.'/'.$files.".php")) {
	                file_put_contents("../howomathfilesstudentid/".$date.'/'.$files.".php","<?php $"."data = file"."_get_contents(\"../../howomath_student/".$studentid."/".$date."/".$files.".png\");".PHP_EOL);
	                file_put_contents("../howomathfilesstudentid/".$date.'/'.$files.".php","header('Content-type: image/png');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../howomathfilesstudentid/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        } else if (strpos($result[$i]["filename"], ".jpg") !== false){
	            $files = str_replace(".jpg", "", $result[$i]["filename"]);
	            print '<a href="'.'../howomathfilesstudentid/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../howomathfilesstudentid/".$date.'/'.$files.".php")) {
	                file_put_contents("../howomathfilesstudentid/".$date.'/'.$files.".php","<?php $"."data = file_"."get_contents(\"../../howomath_student/".$studentid."/".$date."/".$files.".jpg\");".PHP_EOL);
	                file_put_contents("../howomathfilesstudentid/".$date.'/'.$files.".php","header('Content-type: image/jpeg');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../howomathfilesstudentid/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        } else if (strpos($result[$i]["filename"], ".jpeg") !== false){
	            $files = str_replace(".jpeg", "", $result[$i]["filename"]);
	            print '<a href="'.'../howomathfilesstudentid/'.$date.'/'.$files.'.php">'.$files.'</a><br><br>';
	            if (!file_exists("../howomathfilesstudentid/".$date.'/'.$files.".php")) {
	                file_put_contents("../howomathfilesstudentid/".$date.'/'.$files.".php","<?php $"."data = file_"."get_contents(\"../../howomath_student/".$studentid."/".$date."/".$files.".jpeg\");".PHP_EOL);
	                file_put_contents("../howomathfilesstudentid/".$date.'/'.$files.".php","header('Content-type: image/jpeg');".PHP_EOL, FILE_APPEND);
	                file_put_contents("../howomathfilesstudentid/".$date.'/'.$files.".php","echo $"."data; ?>", FILE_APPEND);
	            }
	        }
	    }
    }
    ?>
</div>
<?php include '../../footer.php' ?>
</body>
</html>
