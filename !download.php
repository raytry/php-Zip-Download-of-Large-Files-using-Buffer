<?php 
	$files = array("testFiles/1.jpg", "testFiles/2.jpg", "testFiles/3.jpg");

	header('Pragma: no-cache'); 
	header('Content-Description: File Download'); 
	header('Content-disposition: attachment; filename="myZip.zip"');
	header('Content-Type: application/octet-stream');
	header('Content-Transfer-Encoding: binary'); 

	//Opening a zip stream
	$files = implode(" ", $files);
	if ($files){
		$fp = popen('zip -r -0 - ' . $files, 'r');
	}

	flush(); //Flushing the butter, pre streaming
	while(!feof($fp)) {
	   	echo fread($fp, 8192);
	}

	//Closing the stream
	if ($files){ 
		pclose($fp);
	}
?>