<?php

session_start();
$classid = $_SESSION["classID"];
$studentid = $_SESSION["studentID"];
$subject = $_SESSION["subject"];

header('Content-type: application/json; charset=utf-8');
$data = $_POST["imagedata"];

$data = preg_replace("/data:[^,]+,/i","",$data);
 
$data = base64_decode($data);
 
$image = imagecreatefromstring($data);
 
imagesavealpha($image, TRUE);

//save_file
$directory_path = "./class_".$classid."/note_".$subject;
$directory_path2 = $directory_path."/".$studentid;

if (!file_exists($directory_path)) {
	mkdir($directory_path);
}
if (!file_exists($directory_path2)) {
	mkdir($directory_path2);
}

function unique_filename($dir_path, $num=0) {
	$path = $dir_path."/".$num.".png";
	
	if(file_exists($path)){
		$num++;
		return unique_filename($dir_path, $num);
	} else {
		return $path;
	}
}
$filepath = unique_filename($directory_path2);

imagepng($image,$filepath);

?>