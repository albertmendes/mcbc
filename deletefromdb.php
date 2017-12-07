<?php
    require("includes/config.php");

    if(isset($_GET["title"]) && isset($_GET["issue"])) {
        db_sanitize($_GET["title"]);
        db_sanitize($_GET["issue"]);
        $query = query("DELETE FROM comics WHERE verified_hash = ? and title = ? and issue = ?", $_SESSION["id"], $_GET["title"], $_GET["issue"]);
    }
?>

