<!-- page class join -->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8mb4";
$dbuser = "hoge";
$dbpass = "hogehoge";

//クリックジャッキング対策
header("X-FRAME-OPTIONS: SAMEORIGIN");

//csrf対策ができない？
//$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
//$token = $_SESSION['token'];

$errorMessage = "";
$errorMessageEnglish = "";
if(isset($_POST["classjoinconfirm"])) {
    $errorMessage = "";
    $errorMessageEnglish = "";
    if (empty($_POST["classid"]) || empty($_POST["studentid"]) || empty($_POST["studentname"])) {
        $errorMessage = "クラスIDまたは学籍番号または名前が未入力です。";
        $errorMessageEnglish = "ClassID or studentID is not entered.";
    } else if ($_POST["studentid"] <= 0) {
        $errorMessage = "StudentIDに0以下の数字は使えません。";
        $errorMessageEnglish = "You cannot use numbers less than 0 for your studentID.";
    } else if (mb_strlen($_POST["classid"]) < 6) {
        $errorMessage = "ClassIDは6文字以上です。";
        $errorMessageEnglish = "ClassID should be at least 6 characters.";
    } else if (!preg_match("/\A[a-z\d]{6,100}+\z/i" , $_POST["classid"])) {
        $errorMessage = "ClassIDは半角英数字のみにしてください。";
        $errorMessageEnglish = "ClassID should be a single-byte alphanumeric characters.";
    } else if (preg_match("/\A[^0-9]+\z/", $_POST["studentid"])) {
        $errorMessage = "StudentIDは半角数字のみにしてください。";
        $errorMessageEnglish = "StudentID should be a half-width number.";
    } 
    
    if (!empty($_POST["classid"]) && !empty($_POST["studentid"]) && !empty($_POST["studentname"]) && $errorMessage == "") {
        $classid = $_POST["classid"];
        $studentid = $_POST["studentid"];
        $teacherid = 0;
        //pdoでclassidの存在チェック (存在しないclassidを拒否)
        try {
            $dbh = new PDO($dsn, $dbuser, $dbpass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            $stmt = $dbh->prepare('SELECT * FROM class WHERE classid = :classid LIMIT 1');
            $stmt->bindValue(':classid', $classid, PDO::PARAM_STR);
            $stmt->execute();
            
            $stmt2 = $dbh->prepare('SELECT * FROM users WHERE classid = :classid AND studentid = :studentid LIMIT 1');
            $stmt2->bindValue(':classid', $classid, PDO::PARAM_STR);
            $stmt2->bindValue(':studentid', $studentid, PDO::PARAM_INT);
            $stmt2->execute();
            
            $stmt3 = $dbh->prepare('SELECT * FROM users WHERE classid = :classid AND studentid = :teacherid LIMIT 1');
            $stmt3->bindValue(':classid', $classid, PDO::PARAM_STR);
            $stmt3->bindValue(':teacherid', $teacherid, PDO::PARAM_INT);
            $stmt3->execute();
            
            $result = $stmt->fetch();
            $result2 = $stmt2->fetch();
            $result3 = $stmt3->fetch();
            
            if ($result > 0) {
                if ($result2 > 0) {
                    $errorMessage = "その学籍番号は既に存在しています。";
                    $errorMessageEnglish = "That studentID already exists.";
                } else {
                    $_SESSION["classname"] = $result["classname"];
                    $_SESSION["classid"] = $_POST["classid"];
                    $_SESSION["teachername"] = $result3["studentname"];
                    $_SESSION["studentid"] = $_POST["studentid"];
                    $_SESSION["studentname"] = $_POST["studentname"];
                    
                    header("Location: ./pageclassjoinconfirm.php");
                    exit();
                }
            } else {
                $errorMessage = "そのClassIDは存在しません。";
                $errorMessageEnglish = "The ClassID does not exist.";
            }
        } catch (PDOException $e) {
            $errorMessage = "データベースエラー";
            echo $e->getMessage();
        }
    }
}else if(isset($_POST["back"])) {
    header("Location: ./pageclass.php");
    exit();
}

?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-クラス参加</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
	<h1>クラス参加<span>class participation</span></h1>
	<div>参加したいクラスのIDと学籍番号を入力してください。<br>
	     Please enter the classID and studentID number you want to participate.<br>
	     学籍番号は1以上の半角数字を入力してください。<br>
	     Please enter one or more half-width numbers for the studentID.<br>
	</div>
	<div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
	<div class="red"><?php echo htmlspecialchars($errorMessageEnglish, ENT_QUOTES); ?></div>

	<form action="" method="post">
		<label for="classid">&emsp;&emsp;&nbsp;&nbsp;&thinsp;ClassID:</label>
		<input type="text" class="textbox2" name="classid" placeholder="ClassID"><br>
		<label for="studentid">&emsp;&nbsp;&thinsp;StudentID:</label>
		<input type="text" class="textbox2" name="studentid" placeholder="学籍番号"><br>
		<label for="studentname">Studentname:</label>
		<input type="text" class="textbox2" name="studentname" placeholder="クラスでの名前"><br><br>
		<button type="submit" class="registration" name="classjoinconfirm">確認画面へ<br>To confirmation screen</button><br><br>
		<button type="submit" class="registration" name="back">戻る<br>Back to previous page</button>
	</form>
</div>
<?php include './footer.php' ?>

</body>

</html>