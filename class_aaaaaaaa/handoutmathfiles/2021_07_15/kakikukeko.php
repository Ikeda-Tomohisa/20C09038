<?php $data = file_get_contents("../../handoutmath/2021_07_15/kakikukeko.png");
header('Content-type: image/png');
echo $data; ?>