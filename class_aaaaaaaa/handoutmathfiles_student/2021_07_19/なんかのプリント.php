<?php $data = file_get_contents("../../handoutmath_student/11/2021_07_19/なんかのプリント.png");
header('Content-type: image/png');
echo $data; ?>