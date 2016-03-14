<?php
ob_clean();
//if(isset($_POST['file_name'])){
//$file = $_POST['file_name'];
$file = "FicherosUpload/1.PNG";
$filename = basename($file);
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment; filename="'.$filename.'"');
readfile($file);
exit();
//}
