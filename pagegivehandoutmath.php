<!-- page give handout math-->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$classid = $_SESSION["classID"];
$studentid = $_SESSION["studentID"];
$subject = "math";
$imagetype = "print";

$errorMessage = "";
$errorMessageEnglish = "";
$fileuploadMessage = "";
$fileuploadMessageEnglish = "";

if(isset($_POST["givehandout"])) {
    $errorMessage = "";
    $errorMessageEnglish = "";
    //print_r($_FILES);
    //print_r($_FILES["image"]["name"]);
    if($_FILES['image']['size'] === 0) {
        $errorMessage = "ファイルが選択されていません。";
        $errorMessageEnglish = "No file selected.";
    } else if ($_FILES['image']['type'] !== "image/png" && $_FILES['image']['type'] !== "image/jpeg") {
        $errorMessage = "png/jpg画像を選んでください。";
        $errorMessageEnglish = "Please select a png/jpg image.";
    } else if (is_null($classid)) {
        $errorMessage = "クラスに参加していません。クラス未参加だとこの機能は使えません。";
        $errorMessageEnglish = "NOT participate in the class.This function cannot be used if you don't participate in the class.";
    }

    if ($errorMessage == "") {
        $filename = $_FILES['image']['name'];
        $date = date("Y_m_d");
        $tmpfilename = $_FILES['image']['tmp_name'];
        
        date_default_timezone_set('Asia/Tokyo');
        $directory_path = "class"."_".$classid;
        $directory_path2 = $directory_path."/handoutmath";
        $directory_path3 = $directory_path2."/".$date;
        
        if(!file_exists($directory_path)){
            mkdir($directory_path);
        }
        if(!file_exists($directory_path2)){
            mkdir($directory_path2);
        }
        if(!file_exists($directory_path3)){
            mkdir($directory_path3);
        }
        $save = $directory_path3."/".basename($filename);
        
        try {
            $dbh = new PDO($dsn, $dbuser, $dbpass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            $stmt = $dbh->prepare("SELECT filename FROM images WHERE subject = :subject AND imagetype = :imagetype AND date = :date AND filename = :filename LIMIT 1");
            $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
            $stmt->bindValue(':imagetype', $imagetype, PDO::PARAM_STR);
            $stmt->bindValue(':date', $date, PDO::PARAM_STR);
            $stmt->bindValue(':filename', $filename, PDO::PARAM_STR);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result  == 0) {
                
                $stmt3 = $dbh->prepare("INSERT INTO images(subject, imagetype, date, filename, classid, studentid) VALUES (:subject, :imagetype, :date, :filename, :classid, :studentid)");
                $stmt3->bindValue(':subject', $subject, PDO::PARAM_STR);
                $stmt3->bindValue(':imagetype', $imagetype, PDO::PARAM_STR);
                $stmt3->bindValue(':date', $date, PDO::PARAM_STR);
                $stmt3->bindValue(':filename', $filename, PDO::PARAM_STR);
                $stmt3->bindValue(':classid', $classid, PDO::PARAM_STR);
                $stmt3->bindValue(':studentid', $studentid, PDO::PARAM_INT);
                $stmt3->execute();
            }
            if(move_uploaded_file($tmpfilename, $save)){
                $fileuploadMessage = "アップロード成功！";
                $fileuploadMessageEnglish = "Upload successful";
            }else{
                $fileuploadMessage = "アップロード失敗！";
                $fileuploadMessageEnglish = "Upload failure";
            }
        } catch(Exception $e) {
            $errorMessage = 'データベースエラー';
            $errorMessageEnglish = "Database Error";
            //echo $e->getMessage();
        }
        $dbh = null;
    }
} else if (isset($_POST["back"])) {
    header("Location: ./pagehandoutmathteacher.php");
    exit();
}

?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-プリントを出す</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
    <h1>数学-プリントを出す<span>give mathematics-handout</span></h1>
    <div class="red">
    同じ日に同じ名前のファイルをアップロードした場合は上書きされます。<br>
    If you upload the same file name on the same day,it will be overwritten.
    </div><br>
    <div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
    <div class="red"><?php echo htmlspecialchars($errorMessageEnglish, ENT_QUOTES); ?></div>
    <div class="bigbold"><?php echo htmlspecialchars($fileuploadMessage, ENT_QUOTES); ?></div>
    <div class="bold"><?php echo htmlspecialchars($fileuploadMessageEnglish, ENT_QUOTES); ?></div>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image"><br><br>
        
        <button type="submit" class="registration" name="givehandout">ファイルに送信する<br>Send this file</button><br><br>
        <button class="registration" name="back">戻る<br>Back to previous page</button><br>
    </form>
</div>
<?php include './footer.php' ?>
</body>
</html>