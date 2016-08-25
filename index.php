<?php

    require 'main.php';
    
?>

<html>
    <head>
        <title>Update all the Langs</title>
    </head>
    <body>
        <h2>Enter the details Required</h2>
        <h4>Select the directory Path</h4>
        <select name="dir_path" onChange="change_dir(value)">
            <option value="" disabled selected hidden>Select Path</option>
            <option value="softaculous">Softaculous</option>
            <option value="webuzo">Webuzo</option>
        </select><br><br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <select name="file_name" required onChange="opt_check(value)">
                <option value="" disabled selected hidden>Select a file</option>
                <option value="create_file">Create a New File</option>
            </select><br><br>
            <input name="nfile_name" required autocomplete="off" type="hidden" placeholder="File Name"><br><br>
            <textarea rows="10" name="var_name"  cols="24" placeholder="Variable Name"  required></textarea><br>
            <textarea rows="10" name="var_value" cols="24" placeholder="Variable Value" required></textarea><br><br>
            <input type="checkbox" id="skip_en" name="skip_en"><label for="skip_en">Skip English</label><br><br>
            <input type="hidden" name="path" value="">
            <input type="submit" name="_submit" value="Submit">
        </form><br>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
        <script src="js_funtions.js"></script>
    </body>
</html>
