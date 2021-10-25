<!-- math -->

<?php
session_start();
$classid = $_SESSION["classID"];
?>

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>myapp-算数</title>
<link rel="stylesheet" href="./css/stylemaincontents.css">
</head>

<?php
$imgs = [];
$dir = "./class_".$classid."/textbook_math/";
$handle = opendir($dir);
while(false !== ($filename = readdir($handle))) {
    if(is_file($dir . $filename)) {
        $imgs[] = $filename;
    }
}
closedir($handle);
$json_array = json_encode($imgs);
?>
<script type="text/javascript">
let imgs = <?php echo $json_array; ?>;
var classid = "<?php echo $classid ?>";
console.log(imgs);
console.log(classid);
</script>
<script src="./js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./js/notedrawing.js"></script>
<script type="text/javascript" src="./js/mathtextbookpagechange.js"></script>

<body>
<?php include './header.php' ?>

<div id="tab">tab</div>
<div id="box">
    <div id="textside">textbook<br>
        <div id="textbook">
            <img>
        </div><br>
        <div id="center">
            <button id="firstpage">最初へ</button>
            <button id="previouspage">前ページ</button>
            <p id="pagenumber"></p>
            <button id="nextpage">次ページ</button>
            <button id="lastpage">最後へ</button>
        </div>
    </div>
    <div id="noteside">note</button>
        <div id="note">
             <canvas id="canvas"></canvas>
        </div><br>
        <div id="center">
        <input type="button" id="undo" name="undo" value="undo">
        <input type="button" id="redo" name="redo" value="redo">
        </div>
        
    </div>

</div>
</body>
</html>