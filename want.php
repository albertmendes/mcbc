<?php
    require("includes/config.php");

    $rows = query("SELECT * from comics WHERE verified_hash = ? AND woh=\"want\"", $_SESSION["id"]);

    in_render("want_page.php", ["title" => "MCBC Want List", "dbstuff" => $rows]);

?>
