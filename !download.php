<?php 
	$dirname = basename(getcwd());

	header('Pragma: no-cache'); 
	header('Content-Description: File Download'); 
	header('Content-disposition: attachment; filename="' . $dirname . '.zip"');
	header('Content-Type: application/octet-stream');
	header('Content-Transfer-Encoding: binary'); 

	// Opening a zip stream
	$fp = popen('cd ..; zip -x \*.php -r -0 - ' . $dirname . '/*', 'r');

	flush(); // Flushing the butter, pre streaming
	while(!feof($fp)) {
	   	echo fread($fp, 8192);
	}

	// Closing the stream
	pclose($fp);
?>