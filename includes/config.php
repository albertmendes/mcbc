<?php

    ini_set("display_errors", true);

    error_reporting(0);

    require("includes/constants.php");
    require("includes/functions.php");


    // Cookie expires in a year
    $session_lifetime = time() + 365 * 24 * 3600;
    session_start();
    setcookie(session_name(), session_id(), $session_lifetime);


    if(!preg_match("{(?:login|logout|register|verify|verified|contact)\.php$}", $_SERVER["PHP_SELF"])) {
        if(empty($_SESSION["id"])) {
            redirect("http://mcbc.ml/register.php");
        }
    }
?>
