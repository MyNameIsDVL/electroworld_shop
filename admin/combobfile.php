<?php
    $dir_path = "../files";
    $option = '';

    if (is_dir($dir_path))
    {
         $files = opendir($dir_path);
        {
            if ($files)
            {
                while (($files_name = readdir($files)) !== FALSE)
                {
                    if ($files_name != '.' && $files_name != '..')
                    {
                        $option = $option."<option>$files_name</option>";
                        echo $files_name."<br>";
                    }
                }
            }
        }              
    }
?>