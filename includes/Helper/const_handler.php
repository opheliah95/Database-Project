<?php
    // a script hold all const values
    define("ROOT_PATH", __DIR__);
    define("SPACE", " ");
    define("BACKSLASH", "\\");
    define("HELPER_DIR", "Helper");
    define("USER_FOLDER", "User");
    define("USER_PAGE_PATH", "\userpage.php");

    $include = explode(HELPER_DIR, __DIR__)[0];
    define("INCLUDE_PATH", $include);

    // two important paths --Database and Header
    $DB_Path = INCLUDE_PATH."dbconnection.php";
    $Header_Path = INCLUDE_PATH."header.php";
    $User_Path = INCLUDE_PATH.USER_FOLDER;

    define("DB_PATH", $DB_Path);
    define("HEADER_PATH", $Header_Path);
    define("USER_DIR_PATH", $User_Path);

?>