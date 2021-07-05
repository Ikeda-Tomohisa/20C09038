<!-- page give homework math-->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$userid = $_SESSION["userID"];

$errorMessage = "";
$errorMessageEnglish = "";

if(isset($_POST["givehomework"])) {
    $errorMessage = "";
    $errorMessageEnglish = "";
    //print_r($_FILES);
    if(!isset($_FILES['image'])){
    $errorMessage = "ファイルが選択されていません。";
    $errorMessageEnglish = "No file selected.";
    
    } else {
        try {
            $dbh = new PDO($dsn, $dbuser, $dbpass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $stmt = $dbh->prepare('SELECT * FROM user WHERE userid = :userid');
            $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $classid = $row['classid'];
            
            if (is_null($classid)) {
                $errorMessage = "クラスに参加していません。クラス未参加だとこの機能は使えません。";
                $errorMessageEnglish = "NOT participate in the class.This function cannot be used if you don't participate in the class.";
            } else if ($errorMessage == "") {
                $directory_path = "./homeworkmath"."_".$classid;
                
                if(!file_exists($directory_path)){
                    mkdir($directory_path);
                }
                $save = $directory_path."/".basename($_FILES['image']['name']);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $save)){
                    echo 'アップロード成功！';
                }else{
                    echo 'アップロード失敗！';
                }
            }
            $dbh = null;
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$e->getMessage();
            //echo $e->getMessage();
        }
    }
} else if (isset($_POST["back"])) {
    header("Location: ./pagehowomathteacher.php");
    exit();
}

?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-宿題を出す</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
    <h1>数学-宿題を出す<span>give mathematics-homework</span></h1>
    <div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
    <div class="red"><?php echo htmlspecialchars($errorMessageEnglish, ENT_QUOTES); ?></div>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image"><br><br>
        
        <button type="submit" class="registration" name="givehomework">ファイルに送信する<br>Send this file</button><br><br>
        <button class="registration" name="back">戻る<br>Back to previous page</button><br>
    </form>
</div>
<?php include './footer.php' ?>
</body>
</html>