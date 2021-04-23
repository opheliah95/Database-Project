<?php
    // a script hold all const values
    define("ROOT_PATH", __DIR__);
    define("SPACE", " ");
    define("BACKSLASH", "\\");
    define("HELPER_DIR", "Helper");
    define("USER_FOLDER", "User");
    define("USER_PAGE_PATH", "\userpage.php");
    define("DOC_ROOT", $_SERVER['DOCUMENT_ROOT']);

    $include = explode(HELPER_DIR, __DIR__)[0];
    define("INCLUDE_PATH", $include);

    // two important paths --Database and Header
    $DB_Path = INCLUDE_PATH."dbconnection.php";
    $Header_Path = INCLUDE_PATH."header.php";
    $User_Path = INCLUDE_PATH.USER_FOLDER;

    define("DB_PATH", $DB_Path);
    define("HEADER_PATH", $Header_Path);
    define("USER_DIR_PATH", $User_Path);

    // define project path
    $findme = str_replace('\\', '/', DOC_ROOT); 
    $mystring = str_replace('\\', '/', ROOT_PATH); 

    // find occurance of document path in root
    $pos = strpos($mystring, $findme);
    $length = strlen($findme);

    // find the offset
    $offset = $pos + $length;

    // construct new string
    $newString = explode(HELPER_DIR, substr($mystring, $offset))[0];
    define("PROJ_PATH", $newString);

?>