<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="MCBC lets you catalogue your comic book collection and manage a want list.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale= 1.0">
        <meta charset="utf-8">

        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/fonts.css" rel="stylesheet" />  
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300,400' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <script src="/js/ie10-viewport-bug-workaround.js"></script>

        <?php if(isset($title)): ?>
            <title><?= htmlspecialchars($title) ?> </title>
        <?php else: ?>
            <title>Someproject (beta)</title>
        <?php endif ?>
    </head>

    <body>
    <script>
        function rechbg(img) {
            var wH = window.innerHeight;
            wH += 70;
            var wW = window.innerWidth;
            $('body').css('background', 'url(images/' + img + ')');
            $('body').css('background-attachment', 'fixed');
            $('body').css('background-repeat', 'no-repeat');
            $('body').css('background-size', wW + 'px ' + wH + 'px');
        }
        /*rechbg('regbg.jpg');
        $(window).resize(function() {
            if(window.innerWidth > 500) {
                rechbg('regbg.jpg');
            }
        });
        */
    </script>
        <div class="navbar navbar-default navbar-static-top" role="navigation">
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
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
                        <!--<li><a href="faq.php"><span class="glyphicon glyphicon-align-left"></span> FAQ</a></li>-->
                        <li><a href="/contact.php"><span class="glyphicon glyphicon-send"></span> Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="background-img">
        </div>

        <div class="container">
        <div class="middle_reg">
