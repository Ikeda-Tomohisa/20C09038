<!-- page  note math teacher-->
<?php
session_start();
$classid = $_SESSION["classID"];
$studentid = $_SESSION["studentID"];
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-ノート一覧</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<?php
$imgs = [];
$dir = "./class_".$classid."/note_math/".$studentid."/";
$handle = opendir($dir);
while(false !== ($filename = readdir($handle))) {
    if(is_file($dir . $filename)) {
        $filename_nopng = str_replace(".png","",$filename);
        $imgs[] = $filename;
        $imgs_nopng[] = $filename_nopng;
    }
}
closedir($handle);
array_multisort($imgs_nopng, $imgs);
//var_dump($imgs);
?>

<body>
<?php include './header.php' ?>

<div class="center">
    <h1>数学-教科書とノート<span>mathematics-textbook and note</span></h1>
    <?php
    for($i = 0; $i < count($imgs); $i++) {
        print '<a href="class_'.$classid.'/note_math/'.$studentid.'/'.$imgs[$i].'">'.$imgs_nopng[$i].'</a>'.PHP_EOL;
        if(($i + 1) % 5 == 0){
            echo "<br>";
        }
    }
    if(($i + 1) % 5 == 0) {
        echo "<br>";
    }else{
        echo "<br><br>";
    }
    //var_dump($imgs);
    ?>
    <button class="registration" onclick="location.href='./pagetextbookandnotemathteacher.php'">戻る<br>Back to previous page</button><br>

</div>
<?php include './footer.php' ?>
</body>
</html>