<?php
    
	require 'functions.php';

	$dir = '';

    //$all_file_list = array_diff(@scandir($dir.'/english/webuzo'), array('.', '..'));

    if(!empty($_POST['_submit'])){
        //sanitize the data
        $data = @sanitize_data();
        
        //Debug
        /*print_r($data);
        die();*/

        //Set and check if the directory exist
        /*if(!set_dir_path($data['path'])){
            die('<h3 style="color:red;">Directory provided doesn\'t exixt ... So don\'t fuck around<h3>');
        }*/

        if($data['file_name'] == 'create_file' && !empty($data['nfile_name'])){
            //get the template data and write the file name
            $template_data = file_get_contents('template.txt');
            $template_data = str_replace('[[file_name]]', $data['nfile_name'], $template_data);
            $nflag = 1;
        }
        

        // after sanitization store the data in the local variable
        $file_name = $data['file_name'];
        $var_name  = explode(',', $data['var_name']);
        $var_value = explode(',', $data['var_value']);
        // check for en skip
        !empty($data['skip_en']) ? $skip_en = 1 : "";

        //check if the name value pair are equal
        if(count($var_name) != count($var_value)) {
            die('<h3 style="color:red">Name and Value pair Don\'t match !!</h3>');
        }

        // get all the folders list
        $main_folder_list = array_diff(scandir(PATH), array('.', '..'));

        // remove english folder(if on) and index.html file
        $main_folder_list = array_diff($main_folder_list , !empty($skip_en)? array('english', 'index.html') : array('index.html'));

        $flag = 0;

        foreach($main_folder_list as $key => $folder_list) {

            if(!empty($nflag)){
                file_put_contents(PATH.''.$folder_list.'/'.$data['path'].'/'.$data['nfile_name'].'.php', $template_data);
                $file_name = $data['nfile_name'].'.php';
            }

            // build the file name
            $file_extract = PATH.''.$folder_list.'/'.$data['path'].'/'.$file_name;
            // get the data
            $file_contents = file($file_extract);
            // delete the white spaces at the end of the array
            for($i = (count($file_contents) - 1); $i > 0; $i--){
                $file_contents[$i] = trim($file_contents[$i]);
                if(empty($file_contents[$i])){
                    unset($file_contents[$i]);
                }else{
                    break;
                }
            }

            for($i = 0; $i < count($var_value); $i++) {
                // build the string to write
                $str = "\n\$l['".$var_name[$i]."'] = '".$var_value[$i]."';";
                $file_contents[] = $str;
            }

            //write to file
            if(!file_put_contents($file_extract, $file_contents)){
                echo '<span style="color:red;font-size:15px">Unable to write to file :'.$file_extract.'</span><br>';
                $flag = 1;
            }

        }

        if($flag){
          echo '<span style="color:red;font-size:20px">Some errors were found , please resolve them and try again</span>';
        }else{
          echo '<span style="color:green;font-size:20px">All files done</span>';
        }
    }else{

        if(PHP_OS == 'Linux'){
            $who_ami = exec('whoami');
            $owner = posix_getpwuid(fileowner(__FILE__));
            if($who_ami != $owner['name']){
                echo "<h3 style='color:red;'>Owner and whoami don't match</h3><h3>Note: Chmod 0777 all the lang files or Run via suPHP</h3>";
            }
        }
    }


?>