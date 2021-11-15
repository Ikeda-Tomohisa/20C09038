<?php

/*
$dsn = "mysql:host=localhost; dbname=userlist; charset=utf8";
$dbuser = "hoge";
$dbpass = "hogehoge";
$classid = "aaaaaaaa";

$dbh = new PDO($dsn, $dbuser, $dbpass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$stmt = $dbh->prepare('SELECT date FROM images WHERE classid = :classid');
$stmt->bindValue(':classid', $classid, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($result);
*/

//$date = date("Y_m_d");
///echo $date;
//var_dump($date);

//$img = file_get_contents("./class_aaaaaaaa/handoutmath/2021_07_13/aiueo.png");
//header('Content-type: image/png');
//echo $img;

//$file = './class_aaaaaaaa/handoutmath/2021_07_13/aiueo.png';
//header('Content-type: image/png');
//readfile($file);

//echo mb_substr_count("aiueo.txt.png", ".");

//$str = ".png.png.png";
//$str = str_replace(".png","a",$str);
//echo $str;

date_default_timezone_set('Asia/Tokyo');
//$date = new DateTimeImmutable();
//echo $date->format("Y-m-d H:i:s.v"); 

/*
$now0 = date("YmdHis");
$now = microtime();
$now2 = substr(explode(".",$now)[1],0,3);

$now3 = $now0.$now2;
$now4 = (int)$now3;
echo $now4;
var_dump($now3);
var_dump($now4);
*/

//$imgs = ["a","b","c","d","e"];
//print_r($imgs);
//結果 Array ( [0] => a [1] => b [2] => c [3] => d [4] => e )
//echo count($imgs);
//結果 5

//$result = glob("./*");
//var_dump($result);
/*
$imgs = [];
$dir = "./textbook_math/";
$handle = opendir($dir);

while(false !== ($filename = readdir($handle))) {
    if(is_file($dir . $filename)) {
        $imgs[] = $filename;
    }
}
closedir($handle);
print_r($imgs);
*/

$imgs = [];
$dir = "./class_aaaaaaaa/note_math/0/";
$handle = opendir($dir);

while(false !== ($filename = readdir($handle))) {
    if(is_file($dir . $filename)) {
        $filename_nopng = str_replace(".png","",$filename);
        $imgs[] = $filename;
        $imgs_nopng[] = $filename_nopng;
    }
}
closedir($handle);
//sort($imgs);
//sort($imgs_nopng);
array_multisort($imgs_nopng, $imgs);
print_r($imgs);
print_r($imgs_nopng);
print_r(count($imgs));
//var_dump($imgs[0]);

$json_array = json_encode($imgs);

?>
<script>
let imgs = <?php echo $json_array; ?>;
console.log(imgs[0]);
console.log("Hello World");
</script>
