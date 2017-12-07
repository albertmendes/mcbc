<?php
    require("includes/config.php");


    if(isset($_GET["title"]) && isset($_GET["imgsmall"]) && isset($_GET["imgbig"]) && isset($_GET["item"])) {
        db_sanitize($_GET["title"]);
        db_sanitize($_GET["imgsmall"]);
        db_sanitize($_GET["imgbig"]);
    }
    else {
        exit;
    }

    if($_GET["item"] !== "want" && $_GET["item"] !== "have") {
        exit;
    }


    list($title, $issue) = explode("#", $_GET["title"]);

    if($_GET["item"] == "have") {
        $ins = query("DELETE FROM comics WHERE verified_hash = ? and title = ? and issue = ? and woh = \"want\"", $_SESSION["id"], $title, $issue);
        $ins = query("INSERT IGNORE INTO comics (verified_hash, title, issue, woh, imgsmall, imgbig) values (?,?,?,?,?,?)", $_SESSION["id"], $title, $issue, $_GET["item"], $_GET["imgsmall"], $_GET["imgbig"]);

    }
    else {
        $ins = query("DELETE FROM comics WHERE verified_hash = ? and title = ? and issue = ? and woh = \"have\"", $_SESSION["id"], $title, $issue);
        $ins = query("INSERT IGNORE INTO comics (verified_hash, title, issue, woh, imgsmall, imgbig) values (?,?,?,?,?,?)", $_SESSION["id"], $title, $issue, $_GET["item"], $_GET["imgsmall"], $_GET["imgbig"]);

    }

    /*$ins = query("INSERT IGNORE INTO comics (verified_hash, title, issue, woh, imgsmall, imgbig) values (?,?,?,?,?,?)", $_SESSION["id"], $title, $issue, $_GET["item"], $_GET["imgsmall"], $_GET["imgbig"]);*/

    echo "Added $title#$issue to " . $_GET["item"] . " list.";

?>
