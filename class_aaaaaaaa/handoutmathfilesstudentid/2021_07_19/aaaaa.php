<?php $data = file_get_contents("../../handoutmath_student/11/2021_07_19/aaaaa.jpg");
header('Content-type: image/jpeg');
echo $data; ?>