<?php
if(is_array($_FILES)) {
	if(is_uploaded_file($_FILES['File']['tmp_name'])) {
		$sourcePath = $_FILES['File']['tmp_name'];
		$targetPath = "../FicherosUpload/".$_FILES['File']['name'];
		if(move_uploaded_file($sourcePath,$targetPath)){
			echo $targetPath;
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "error";
	}
}
else
{
	echo "error";
}
?>