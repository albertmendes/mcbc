<?php
    include("includes/config.php");

    if(isset($_GET["action"])) {
        if($_GET["action"] == "ehl") {
            $q = query("DELETE FROM comics WHERE verified_hash = ? AND woh = \"have\"", $_SESSION["id"]);
            if($q === false) {
                echo "db error";
                exit;
            }
            echo "Emptied your have list.";
            exit;
        }
        else if($_GET["action"] == "ewl") {
            $q = query("DELETE FROM comics WHERE verified_hash = ? AND woh = \"want\"", $_SESSION["id"]);
            if($q === false) {
                echo "db error";
                exit;
            }
            echo "Emptied your want list.";
            exit;
        }
        else if($_GET["action"] == "delacc")  {
            $q = query("DELETE FROM comics WHERE verified_hash = ?", $_SESSION["id"]);
            $qt = query("DELETE FROM users WHERE verified_hash = ?", $_SESSION["id"]);
            if($q === false || $qt === false) {
                echo "db error";
                exit;
            }
            logout();
            echo "Deleted your account. Let me walk you outside ..";
            exit;
        }
        else {
            exit;
        }
    }
?>
