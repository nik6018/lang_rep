<?php
        
    //All constants defined here

    define('PATH', '../soft/softaculous/enduser/languages/', TRUE);

    /**
     * Set the default diretory
     * @package lang_rep
     * @version 0.1
     * @param   path to set
     * @author  Nikhil Muskur
     * @return  bool
    */

    function set_dir_path($path = ''){
        if(!empty($path)){
            $dir = $path;
            return true;
        }
        return false;
    }

    /**
     * Checks if the  given directory is present or not
     * @package lang_rep
     * @version 0.1
     * @author  Nikhil Muskur
     * @return  bool
    */

    function chck_dir($path = ''){
        if(is_dir(PATH.''.$path)){
            return true;
        }
        return false;
    }

    /**
     * Trims & Sanitizes the POST req data
     * @package lang_rep
     * @version 0.1
     * @author  Nikhil Muskur
     * @return  sanitized $_POST array
    */
    function sanitize_data(){
        $sanitize_args = array(
            'file_name'  => FILTER_SANITIZE_STRING,
            'nfile_name' => FILTER_SANITIZE_STRING,
            'var_name'   => FILTER_SANITIZE_STRING,
            'var_value'  => FILTER_SANITIZE_STRING,
            'skip_en'    => FILTER_SANITIZE_STRING,
            'path'       => FILTER_SANITIZE_STRING,
        );
        array_filter($_POST, 'trim_value');    // the data in $_POST is trimmed
        $data = filter_input_array(INPUT_POST, $sanitize_args); // sanitze the string
        return $data;
    }

    /**
     * Trim the $_POST array
     * @package lang_rep
     * @version 0.1
     * @param   Data to trim
     * @author  Nikhil Muskur
     * @return  Trimmed $_POST array
    */
    function trim_value($value){
        if(!empty($value)){
            $value = trim($value);
        }
    }

    /**
     * Return the files in Dir
     * @package lang_rep
     * @version 0.1
     * @param   files list
     * @param   ext req
     * @author  Nikhil Muskur
     * @return  $files array
    */
    function get_files($dir, $ext){
        $files = array();
        foreach ($dir as $key => $value) {
            if(!is_dir($value) && in_array(pathinfo($value, PATHINFO_EXTENSION), $ext)){
                $files[] = $value;
            }
        }

        return $files;
    }


?>