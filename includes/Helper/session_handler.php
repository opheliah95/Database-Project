<?php

function check_session(){
    // if session variables are destroyed
    if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
        // display error message
        $session_error = "your current session has expired";

        // create the full path to login page
        $root_path = __DIR__;
        $space = " ";

        // a relative path for login
        $login_pass_rel = $space."login.php?error=session&error=".$session_error;
        $login_pass = $root_path.$login_pass_rel;

        // redirect
        header($login_pass);

       
        return true;
    } 
    else
    {
        return false;
    }
    
    
    }


?>