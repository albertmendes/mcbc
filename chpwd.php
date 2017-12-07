<?php
    require("includes/config.php");

    $dbstuff = query("SELECT * FROM users WHERE verified_hash = ?", $_SESSION["id"]);
    if(count($dbstuff == 1)) {
        $dbstuff = $dbstuff[0];
    }
    else {
        echo "ERROR";
        exit;
    }

    $newpwd = crypt($_GET["newpwd"]);
    $oldpwd = crypt($_GET["oldpwd"], $dbstuff["hash"]);

    if($dbstuff["hash"] !== $oldpwd) {
        echo "Wrong old password.";
        exit;
    }

    $update = query("UPDATE users set hash = ? where verified_hash = ?", $newpwd, $_SESSION["id"]);

    if($update === false) {
        echo "Error changing password.";
    }
    else {
        echo "Password successfully changed.";
    }

?>
