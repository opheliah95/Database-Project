<?php
include_once("path_handler.php");

function check_session(){
    // if session variables are destroyed
    if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
        // display error message
        $session_error = "your current session has expired";

        // generate path to redirect
        $login_pass_rel = "login.php?error=session&error=".$session_error;
        $login_pass = generate_path($login_pass_rel);

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