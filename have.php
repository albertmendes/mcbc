<?php
    require("includes/config.php");

    $rows = query("SELECT * from comics WHERE verified_hash = ? AND woh=\"have\"", $_SESSION["id"]);

    in_render("have_page.php", ["title" => "MCBC Have List", "dbstuff" => $rows]);

?>
