<?php
session_start();

$classid = $_SESSION["classID"];

if($imagetype == "print") {
    $filepath = '../../handoutmath/'.$date.'/'.$file;
} else if ($imagetype == "homework") {
    $filepath = '../../howomath/'.$date.'/'.$file;

}
header('Content-Type: application/force-download');
header('Content-Length: '.filesize($filepath));
header('Content-Disposition: attachment; filename="'.$file.'"');

readfile($filepath);
?>