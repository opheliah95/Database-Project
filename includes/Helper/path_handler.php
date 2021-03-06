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

    // normal generate path function
    function generate_path_comm($path)
    {
        $full_path = INCLUDE_PATH.$path;
        return $full_path;
    }
    
     // normal generate path function
     function relative_path($path)
     {
         $full_path = INCLUDE_PATH.$path;
         return $full_path;
     }

     // return project path: /[PROJName]/[Dir]/[Dir]
     function return_project_path()
     {
         return PROJ_PATH;
     }

     // return project path: /[PROJName]/[Dir]/[Dir]
     function return_url_path($path)
     {
         return PROJ_PATH.$path;
     }

?>