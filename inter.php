<?php

require 'functions.php';
	
	
if(isset($_POST['path_val'])){
	//Get the files
	$path = ($_POST['path_val'] == 'softaculous' ? 'english' : 'english/webuzo');

	if(!chck_dir($path)){
        echo 'Specified Directory doesnt exist';
    }else{
    	$dir = array_slice(scandir(PATH.''.$path), 2);

		$files = array();

		//Get rid of dir and .html files
		$files = get_files($dir, array('php'));

		//Return the files
		$files = json_encode($files);
		echo $files;
    }
}


?>