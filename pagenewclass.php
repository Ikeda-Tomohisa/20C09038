<!-- new class pagenewclass -->

<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";

//クリックジャッキング対策
header("X-FRAME-OPTIONS: SAMEORIGIN");

//csrf対策ができない？
//$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
//$token = $_SESSION['token'];

$errorMessage = "";
$errorMessageEnglish = "";
if(isset($_POST["newclassconfirm"])) {
    $errorMessage = "";
    $errorMessageEnglish = "";
    if (empty($_POST["classname"]) || empty($_POST["classid"])) {
        $errorMessage = "クラス名またはクラスIDが未入力です。";
        $errorMessageEnglish = "Classname or classID is not entered.";
    } else if (mb_strlen($_POST["classid"]) < 6) {
        $errorMessage = "ClassIDは6文字以上にしてください。";
        $errorMessageEnglish = "ClassID should be at least 6 characters.";
    } else if (!preg_match("/\A[a-z\d]{8,100}+\z/i" , $_POST["classid"])) {
        $errorMessage = "ClassIDは半角英数字にしてください。";
        $errorMessageEnglish = "ClassID should be a single-byte alphanumeric characters.";
    }
    
    if (!empty($_POST["classname"]) && !empty($_POST["classid"]) && $errorMessage == "") {
        $classid = $_POST["classid"];
        //pdoでclassidの重複チェック（既にあるclassidを拒否)
        try {
            $dbh = new PDO($dsn, $dbuser, $dbpass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query = $dbh->prepare('SELECT * FROM class WHERE classid = :classid limit 1');
            $query->bindValue(':classid', $classid, PDO::PARAM_STR);
            $query->execute();
            
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result > 0) {
                $errorMessage = "既にそのClassIDは存在します。";
                $errorMessageEnglish = "The ClassID already exists.";
                    
            } else {
                $_SESSION["classname"] = $_POST["classname"];
                $_SESSION["classid"] = $_POST["classid"];
                    
                header("Location: ./pagenewclassconfirm.php");
                exit();
            }
            
        } catch (PDOException $e) {
            $errorMessage = "データベースエラー";
            //$e->getMessage();
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
<title>myapp-クラス新規作成</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
	<h1>クラス新規作成<span>Create new class</span></h1>
	<div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
	<div class="red"><?php echo htmlspecialchars($errorMessageEnglish, ENT_QUOTES); ?></div>
	<div>
	ClassIDは半角英数字・6文字以上で入力してください。<br>
	Please enter the classID using 6 or more single-byte alphanumeric characters.
	</div>
	<form action="" method="post">
	    <label for="username">Classname:</label>
		<input type="text" class="textbox2" name="classname" placeholder="クラス名を入力"><br>
		<label for="pass">&emsp;&nbsp;&thinsp;ClassID:</label>
		<input type="password" class="textbox2" name="classid" placeholder="クラスIDを入力"><br>
		<div class="margintop10"><?php echo "Teacher's name:",$_SESSION["userNAME"] ?><br><br>
		<button type="submit" class="registration" name="newclassconfirm">確認画面へ<br>To confirmation screen</button><br><br>
		<button type="submit" class="registration" name="back">戻る<br>Back to previous page</button>
		<!-- <input type="hidden" name="token" value="<?=$token?>"> -->
	</form>
	
</div>
<?php include './footer.php' ?>
</body>

</html>
