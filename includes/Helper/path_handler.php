<?php

    // a script that will handle all paths

    // consts values
    $root_path = __DIR__;
    $space = " ";  

    // return custom path
    function generate_path($path)
    {
        $full_path = $root_path.$space.$path;
        return $full_path;
    }

    // return root path
    function return_root()
    {
        return root_path;
    }




?>