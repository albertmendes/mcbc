<?php
    require("includes/config.php");

  /*  if(!isset($_SERVER['HTTPS'])) {
        redirect("http://mcbc.ml/register.php");
    }
    */

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $mytimestamp = time();

        //sanitize($_POST["password"]);
        //sanitize($_POST["confirmation"]);
        sanitize($_POST["username"]);
        sanitize($_POST["email"]);

        if(empty($_POST["username"])) {
            render("register_form.php", ["title" => "MCBC - Register a new account", "nousername" => "true"]);
            exit;
        }
        else if(!ctype_alnum($_POST["username"])) {
            render("register_form.php", ["title" => "MCBC - Register a new account", "alnum" => "true"]);
            exit;
        }
        else if(empty($_POST["email"])) {
            render("register_form.php", ["title" => "MCBC - Register a new account", "noemail" => "true", "username" => $_POST["username"]]);
            exit;
        }
        else if(empty($_POST["password"])) {
            render("register_form.php", ["title" => "MCBC - Register a new account", "nopassword" => "true", "username" => $_POST["username"], "email" => $_POST["email"]]);
            exit;
        }

        if(strlen($_POST["password"]) < 8) {
            render("register_form.php", ["title" => "MCBC - Register a new account", "tooshortpassword" => "true", "username" => $_POST["username"], "email" => $_POST["email"]]);
            exit;
        }

        $unique_hash = md5(uniqid());

        $msg = "Click this link to verify or copy and paste it in your browser: http://mcbc.ml/verify.php?key=" . $unique_hash;

        if($_POST["password"] !== $_POST["confirmation"]) {
            render("register_form.php", ["title" => "MCBC - Register a new account", "username" => $_POST["username"], "email" => $_POST["email"], "nomatch" => "true"]);
            exit;
        }
        else {
            $email_q = query("SELECT * FROM users WHERE email = ?", $_POST["email"]);
            if(count($email_q) == 1) {
                render("register_form.php", ["title" => "MCBC - Register a new account", "username" => $_POST["username"], "emailalready" => "true"]);
                exit;
            }
            $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);
            if(count($rows) == 1) {
                render("register_form.php", ["title" => "MCBC - Register a new account", "email" => $_POST["email"], "useralready" => "true"]);
                exit;
            }
            elseif(count($rows) == 0) {
                $newuser_q = query("INSERT INTO users(username, email, hash, verified_hash, verified, timestamp) VALUES(?, ?, ?, ?, 'false', ?)", $_POST["username"], $_POST["email"], crypt($_POST["password"]), $unique_hash, $mytimestamp);
                if($newuser_q === false) {
                    apologize("Error creating user.");
                }

                $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);
                if($rows === false) {
                    apologize("Database error.");
                }

                if(count($rows) == 1) {
                    /*$rows = $rows[0];
                    $_SESSION["id"] = $rows["id"];
                    redirect("/");
                    */
                    $header = 'From: webmaster@mcbc.ml' . "\r\n" . 
                    'Reply-To: webmaster@mcbc.ml' . "\r\n";
                    @mail($_POST["email"], 'Verification mycomicbookcollection', $msg, $header);
                    render("register_form.php", ["title" => "Check your mail for verification", "veri" => "true"]);
                }
                else {
                    apologize("Database error.");
                }
            }
            else {
                apologize("Error creating user.");
            }
        }
    }
    else {
        render("register_form.php", ["title" => "MCBC - Register a new account"]);
    }
?>
