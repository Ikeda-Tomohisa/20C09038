<?php
header('Content-type: application/json; charset=utf-8');
$data = $_POST["data"];
//$data = file_get_contents('php://input');

$data = preg_replace("/data:image/png;base64,/i","",$data);
 
//残りのデータはbase64エンコードされているので、デコードする
$data = base64_decode($data);
 
//まだ文字列の状態なので、画像リソース化
$image = imagecreatefromstring($data);
 
//画像として保存（ディレクトリは任意）
imagesavealpha($image, TRUE);
imagepng($image, "./sample.png");

?>