<?php
    // a script hold all const values
    define("ROOT_PATH", __DIR__);
    define("SPACE", " ");
    define("BACKSLASH", "\\");
    define("HELPER_DIR", "Helper");

    $include = explode(HELPER_DIR, __DIR__)[0];
    define("INCLUDE_PATH", $include);

    // two important paths --Database and Header
    $DB_Path = INCLUDE_PATH."dbconnection.php";
    $Header_Path = INCLUDE_PATH."header.php";

    define("DB_PATH", $DB_Path);
    define("HEADER_PATH", $Header_Path);

?>