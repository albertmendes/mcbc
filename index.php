<?php
    require("includes/config.php");
/*    if(!isset($_SERVER['HTTPS'])) {
        redirect("https://mycomicbookcollection.me");
    }
    */
    in_render("startpage.php", ["title" => "MyComicBookCollection"]);
?>
