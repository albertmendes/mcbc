<?php
    require("includes/config.php");

    if(isset($_GET["key"])) {
        sanitize($_GET["key"]);

        $rows = query("SELECT * from users WHERE verified_hash = ?", $_GET["key"]);
        if(count($rows) == 1) {
            if($rows[0]["verified"] == "true") {
                apologize("You are already verified.");
            }
            else {
                $update_query = query("UPDATE users set verified = 'true' WHERE verified_hash = ?", $_GET["key"]);
                render("verified.php", ["title" => "You are now verified"]);
            }
        }
        else {
            apologize("You're doing it wrooong!");
        }

    }
?>
