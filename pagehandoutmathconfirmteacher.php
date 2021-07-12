<!-- page handout math confirm teacher-->
<?php
session_start();
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>myapp-数学-プリントを確認する</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<?php include './header.php' ?>

<div class="center">
    <h1>数学-プリントを確認する<span>give mathematics-handout</span></h1>
    <?php
    foreach (glob("handoutmath_".$_SESSION["classID"]."/*") as $filename) {
        $filename = str_replace("handoutmath_".$_SESSION["classID"]."/", "", $filename);
        if(strpos($filename, '.php') !== false) {
            $filename = str_replace($filename.".php", "", $filename);
        }
        print '<a href="pagehandoutmathconfirmteacher.php?date=' . $filename . '">' . $filename . '</a><br><br>';
        if(!file_exists("handoutmathdates_".$_SESSION["classID"])){
            mkdir("handoutmathdates_".$_SESSION["classID"]);
        }
        if(!file_exists("handoutmathdates_".$_SESSION["classID"]."/".$filename.".php")){
            file_put_contents("handoutmathdates_".$_SESSION["classID"]."/".$filename.".php","<?php echo hello! ?>\n");
            file_put_contents("handoutmathdates_".$_SESSION["classID"]."/".$filename.".php","<?php echo HELLO! ?>",FILE_APPEND);
        }
    }
    ?>
</div>
<?php include './footer.php' ?>
</body>
</html>