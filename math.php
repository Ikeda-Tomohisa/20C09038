<!-- math -->

<?php
session_start();
$classid = $_SESSION["classID"];
$_SESSION["subject"] = "math";
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
        $filename_no = str_replace("tbmath_","",$filename);
        $filename_no = str_replace("tbmath","0",$filename_no);
        $filename_no = str_replace(".png","",$filename_no);
        $imgs[] = $filename;
        $imgs_no[] = $filename_no;
    }
}

closedir($handle);
array_multisort($imgs_no, $imgs);
//var_dump($imgs_no);
//var_dump($imgs);
$json_array = json_encode($imgs);
?>

<script type="text/javascript">
let imgs = <?php echo $json_array; ?>;
var classid = "<?php echo $classid ?>";
//console.log(imgs);
//console.log(classid);
</script>


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
    <div id="noteside">note
        <div id="note">
             <canvas id="canvas"></canvas>
        </div>
        <div id="center">
            <input type="button" id="undo" name="undo" value="一つ前へ">
            <input type="button" id="redo" name="redo" value="一つ後へ">
            <input type="button" id="clear" name="clear" value="消去">
            <input type="button" id="save" name="save" value="保存">
            <p>線の太さ<input type="range" min="1" max="15" value="3" id="lineWidth"><span id="lineNum">3</span></p>
            <div id="cursor">
            <ul>
            <li style="background-color:#000000"></li>
            <li style="background-color:#808080"></li>
            <li style="background-color:#ffffff"></li>
            <li style="background-color:#ffff00"></li>
            <li style="background-color:#00ff00"></li>
            <li style="background-color:#3eb370"></li>
            <li style="background-color:#00552e"></li>
            <li style="background-color:#0000ff"></li>
            <li style="background-color:#4c6cb3"></li>
            <li style="background-color:#00ffff"></li>
            <li style="background-color:#ff00ff"></li>
            <li style="background-color:#fce2c4"></li><br>
            <li style="background-color:#ffa500"></li>
            <li style="background-color:#f8b500"></li>
            <li style="background-color:#ee7800"></li>
            <li style="background-color:#ff0000"></li>
            <li style="background-color:#eb6101"></li>
            <li style="background-color:#eb6ea5"></li>
            <li style="background-color:#884898"></li>
            <li style="background-color:#7058a3"></li>
            <li style="background-color:#965042"></li>
            <li style="background-color:#6f4b3e"></li>
            <li style="background-color:#c0c0c0"></li>
            <li style="background-color:#e6b422"></li>
            </ul>
            </div>
        </div>
    </div>
</div>
<script src="./js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./js/mathtextbookpagechange.js"></script>
<script type="text/javascript" src="./js/notedrawing.js"></script>
</body>
</html>