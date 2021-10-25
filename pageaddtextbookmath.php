<!-- page add textbook math-->
<?php
session_start();

$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$classid = $_SESSION["classID"];
$studentid = $_SESSION["studentID"];
$subject = "math";

$errorMessage = "";
$errorMessageEnglish = "";
$fileuploadMessage = "";
$fileuploadMessageEnglish = "";

if(isset($_POST["addtextbook"])) {
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
        $ext = pathinfo($filename);
        //var_dump($ext);
        $filename = "tbmath.".$ext['extension'];
        
        $tmpfilename = $_FILES['image']['tmp_name'];
        
        $directory_path = "class"."_".$classid;
        $directory_path2 = $directory_path."/textbook_".$subject;
        
        if(!file_exists($directory_path)){
            mkdir($directory_path);
        }
        if(!file_exists($directory_path2)){
            mkdir($directory_path2);
        }
        
        $save = "./".$directory_path2."/".basename($filename);
        //var_dump($save);
        
        function unique_filename($org_path, $num=0){
            if($num > 0){
                $info = pathinfo($org_path);
                $path = $info['dirname'] . "/" . $info['filename'] . "_" . $num;
                if(isset($info['extension'])){
                    $path .= "." . $info['extension'];
                }
            } else {
                $path = $org_path;
            }
            
            if(file_exists($path)){
                $num++;
                return unique_filename($org_path, $num);
            } else {
                return $path;
            }
        }
        $filepath = unique_filename($save);
            
        try {
            if(move_uploaded_file($tmpfilename, $filepath)){
                $fileuploadMessage = "アップロード成功！";
                $fileuploadMessageEnglish = "Upload successful";
            }else{
                $fileuploadMessage = "アップロード失敗！";
                $fileuploadMessageEnglish = "Upload failure";
            }
        } catch(Exception $e) {
            $errorMessage = 'PHPエラー';
            $errorMessageEnglish = "PHP Error";
            //echo $e->getMessage();
        }
    }
} else if (isset($_POST["back"])) {
    header("Location: ./pagetextbookandnotemathteacher.php");
    exit();
}

?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-教科書の追加</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
    <h1>数学-教科書の追加<span>add mathematics-textbook</span></h1>
    <!--
    <div class="red">
    同じ日に同じ名前のファイルをアップロードした場合は上書きされます。<br>
    If you upload the same file name on the same day,it will be overwritten.
    </div><br>
    -->
    <div class="red"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
    <div class="red"><?php echo htmlspecialchars($errorMessageEnglish, ENT_QUOTES); ?></div>
    <div class="bigbold"><?php echo htmlspecialchars($fileuploadMessage, ENT_QUOTES); ?></div>
    <div class="bold"><?php echo htmlspecialchars($fileuploadMessageEnglish, ENT_QUOTES); ?></div>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image"><br><br>
        
        <button type="submit" class="registration" name="addtextbook">ファイルに送信する<br>Send this file</button><br><br>
        <button class="registration" name="back">戻る<br>Back to previous page</button><br>
    </form>
</div>
<?php include './footer.php' ?>
</body>
</html>