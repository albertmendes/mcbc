<?php
    if(!empty($_SESSION["id"])) {
        $rows = query("SELECT * FROM users WHERE verified_hash = ?", $_SESSION["id"]);
        if(count($rows) == 1) {
            $username = $rows[0]["username"];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0,maximum-scale = 1.0">
        <meta charset="utf-8">

        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <!--<link href="css/bootstrap-theme.min.css" rel="stylesheet"/>-->
        <link href="css/style.css" rel="stylesheet" />  
        <link href="css/fonts.css" rel="stylesheet" />  
        <link href="css/lightbox.css" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,400' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="/js/main.js"></script>
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <script src="/js/ie10-viewport-bug-workaround.js"></script>
        <script src="js/lightbox.min.js"></script>

        <?php if(isset($title)): ?>
            <title><?= htmlspecialchars($title) ?> </title>
        <?php else: ?>
            <title>Someproject (beta)</title>
        <?php endif ?>
    </head>

    <body>
        <!--<div class="navbar navbar-default navbar-static-top" role="navigation">-->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header">
                    <a class="navbar-brand mylogo" href="/"><img src="images/logoletters.png"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/"><span class="glyphicon glyphicon-search"></span>Search</a></li>
                        <li><a href="/want.php"><span class="glyphicon glyphicon-eye-open"></span> Want</a></li>
                        <li><a href="/have.php"><span class="glyphicon glyphicon-ok"></span> Have</a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php if(!empty($username)) { echo " ($username)";} ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <!--<li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Messages</a></li>-->
                                <li><a href="/settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                            </ul>
                        </li>
                        <!--<li><a href="javascript:void(0);" class="mytooltip" data-toggle="tooltip" data-placement="bottom" title="Help"><span class="glyphicon glyphicon-question-sign"></span></a></li>-->
                        <li><a href="/logout.php" class="mytooltip" data-toggle="tooltip" data-placement="bottom" title="Logout"><span class="glyphicon glyphicon-log-out"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            $('.mytooltip').tooltip({
                animation: "true"
            });
        </script>


        <div class="container-fluid">
        <div class="middle">
