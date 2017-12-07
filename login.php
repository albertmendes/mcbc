<?php
    require("includes/config.php");
    /*
    if(!isset($_SERVER['HTTPS'])) {
        redirect("http://mcbc.ml/login.php");
    }
*/
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $hackfile = getcwd() . "/hackattempts/hackattempts.txt";

        sanitize($_POST["username"]);
        //sanitize($_POST["password"]);

        if(empty($_POST["username"])) {
            render("login_form.php", ["title" => "Log in error - MCBC", "nousername" => "true"]);
            exit;
        }
        else if(!ctype_alnum($_POST["username"])) {
            render("login_form.php", ["title" => "Log in error - MCBC", "alnum" => "true"]);
            exit;
        }
        else if(empty($_POST["password"])) {
            render("login_form.php", ["title" => "Log in error - MCBC", "nopassword" => "true", "username" => $_POST["username"]]);
            exit;
        }

        $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);

        if(count($rows) == 1) {
            $row = $rows[0];

            if(crypt($_POST["password"], $row["hash"]) == $row["hash"] && $row["verified"] == "true") {
                //$_SESSION["id"] = $row["id"];
                $_SESSION["id"] = $row["verified_hash"];

                redirect("http://mcbc.ml");
            }
        }

        if(isset($row["verified"]) && $row["verified"] == "false") {
            apologize("You are not verified, yet. Check your mail for the verification link.");
        }
        else {
            render("login_form.php", ["title" => "Log in error - MCBC", "invalidlogin" => "true"]);
        }
    }
    else {
        render("login_form.php", ["title" => "MCBC - Log in"]);
    }
?>
