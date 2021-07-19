<?php
session_start();

$classid = $_SESSION["classID"];

$filepath = '../../handoutmath/'.$date.'/'.$file;

header('Content-Type: application/force-download');
header('Content-Length: '.filesize($filepath));
header('Content-Disposition: attachment; filename="'.$file.'"');

readfile($filepath);
?>