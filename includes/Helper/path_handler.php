<?php

    // a script that will handle all paths
    include_once("const_handler.php");
 
    // return custom path
    function generate_path($path)
    {
        $full_path = ROOT_PATH.SPACE.$path;
        return $full_path;
    }

    // return root path
    function return_root()
    {
        return root_path;
    }




?>