<?php
    require_once("includes/config.php");

    if(isset($_GET["s"])) {
        search_sanitize($_GET["s"]);
        $sterm = strip_tags(htmlspecialchars($_GET["s"]));
        if(!preg_match("/.+\d{1,4}/", $sterm)) {
            $sterm = $sterm . " 1";
        }
    }
    else {
        exit;
    }
    if(isset($_GET["p"]) && is_numeric($_GET["p"])) {
        search_sanitize($_GET["p"]);
        $page = $_GET["p"];
    }

    $comics_from = "";

    if(isset($_GET["date"])) {
        search_sanitize($_GET["date"]);
        switch($_GET["date"]) {
            case "This week";
                $comics_from = "DW_0";
                break;
            case "Last week";
                $comics_from = "DW_1";
                break;
            case "Past month";
                $comics_from = "ASM_1";
                break;
            case "2 months";
                $comics_from = "ASM_2";
                break;
            case "3 months";
                $comics_from = "ASM_3";
                break;
            case "6 months";
                $comics_from = "ASM_6";
                break;
            case "1 year";
                $comics_from = "ASM_12";
                break;
            case "2 years";
                $comics_from = "ASM_24";
                break;
            case "Pre 1980";
                $comics_from = "1800-1979";
                break;
            case "Pre 1970";
                $comics_from = "1800-1969";
                break;
            case "Pre 1960";
                $comics_from = "1800-1959";
                break;
            case "Pre 1950";
                $comics_from = "1800-1949";
                break;
            case "Pre 1940";
                $comics_from = "1800-1939";
                break;
            case "2000-2015";
                $comics_from = $_GET["date"];
                    break;
            case "1990s";
                $comics_from = "1990-1999";
                break;
            case "1980s";
                $comics_from = "1980-1989";
                break;
            case "1970s";
                $comics_from = "1970-1979";
                break;
            case "1960s";
                $comics_from = "1960-1969";
                break;
            case "1950s";
                $comics_from = "1950-1959";
                break;
            case "1940s";
                $comics_from = "1940-1949";
                break;
            case "1996-2000";
                $comics_from = $_GET["date"];
                break;
            case "1991-1995";
                $comics_from = $_GET["date"];
                break;
            case "1986-1990";
                $comics_from = $_GET["date"];
                break;
            case "1981-1985";
                $comics_from = $_GET["date"];
                break;
            case "1976-1980";
                $comics_from = $_GET["date"];
                break;
            case "1971-1975";
                $comics_from = $_GET["date"];
                break;
            case "1966-1970";
                $comics_from = $_GET["date"];
                break;
            case "1961-1965";
                $comics_from = $_GET["date"];
                break;
            case "1956-1960";
                $comics_from = $_GET["date"];
                break;
            case "1951-1955";
                $comics_from = $_GET["date"];
                break;
            case "1946-1950";
                $comics_from = $_GET["date"];
                break;
            case "1940-1945";
                $comics_from = $_GET["date"];
                break;
        }
    }

    if(empty($_GET["s"])) {
        exit;
    }


    if(strlen($sterm) < 4) {
        print("tooshort");
        exit;
    }
    if(ctype_space($sterm)) {
        print("nothingthere");
        exit;   
    }

    // Get database stuff to check if stuff is already in want or hav elist
    $rows = query("SELECT * FROM comics where verified_hash = ?", $_SESSION["id"]);

    /**********************************************************************************/

    $url = "https://mycomicshop.com/search?q=" . urlencode($sterm) . "&pubid=&PubRng=" . $comics_from;
    if(isset($page) && is_numeric($page)) {
        $url = "https://mycomicshop.com/search?q=" . urlencode($sterm) . "&p=" . $page . "&PubRng=" . $comics_from;
    }

    $myfile = "mcbc_searches/some" . $_SESSION["id"] . "mcbc";
    $ua = "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0";


    $ch = curl_init($url);
    $fp = fopen($myfile, "w");
    if(!$fp) { exit; };

    curl_setopt($ch, CURLOPT_FILE, $fp);
    //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,30);
    //curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    //curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:8118');
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_REFERER, '');

    curl_exec($ch);
    curl_close($ch);
    fclose($fp);

    $fp = fopen($myfile, "r");
    if(!$fp) {
        echo "Can't access search.\n";
        exit;
    }
    
    $comics = array( array() );
    $j = 0;

    $maybe = "";
    $next = "";
    $pages = "";
    while(!feof($fp)) {
        $str = fgets($fp);
        if(preg_match_all('#https://\S+cloudfront.[0-9\.\/\w]+#', $str, $matches)) {
            if(preg_match('/jpg/', $str)) {
            $comics[$j]["img-big"] = $matches[0][0];
            $comics[$j]["img-small"] = $matches[0][1];
            }
        }
        else if(preg_match_all('/No image available/', $str, $matches)) {
            $comics[$j]["img-big"] = "NULL";
            $comics[$j]["img-small"] = "NULL";
        }
        else if(preg_match_all("#div class=\".+href=\".+>(.+?)</a.+?strong>(.+?)</strong#", $str, $titles)) {
            $ti = $titles[1][0] . " " . $titles[2][0];
            $comics[$j]["title"] = $ti;
            $j++;
        }
        // HOW MANY PAGES
        else if(preg_match_all("#search\?q=.+?p=.+?\">(.+?)</a>#", $str, $matches)) {
            $pages = $matches[1][0];
        }
    }
    fclose($fp);

    if(filesize($myfile) == 0) {
        echo "ERROR";
        exit;
    }
    else if(!isset($comics[0]["img-big"])) {
        echo "NORESULTS";
        exit;
    }


    // Print links to all pages
    if(!empty($pages) && is_numeric($pages) && $pages < 100) {
        print("Pages: ");
        for($i = 1; $i <= $pages; $i++) {
            if(isset($page) && $page == $i) {
                echo " $i ";
            }
            else if($i == 1 && !isset($page)) {
                echo " $i ";
            }
            else {
                echo "<a href=\"#\" class=\"page\" data-page=\"" . $i . "\"> [$i] </a>";
            }
        }
        echo "<br />";
    }
    else {
        print("Pages: ");
        echo "<a href=\"#\" class=\"page\" data-page=\"1\"> [1] </a>";
        echo "<br />";
    }

    // Print covers

    foreach($comics as $c) {
        $c["img-big"] = str_replace("http:", "https:", $c["img-big"]);
        $c["img-small"] = str_replace("http:", "https:", $c["img-small"]);


        if(!isset($c["img-small"])) {
            echo "Your search didn't return any results or too many. Try to be more specific!";
            exit;
        }
        if($c["img-small"] == "NULL") {
            echo '<a href="#" class="mytooltip img-item" data-toggle="tooltip" data-placement="top" title="' . $c["title"] .  '"><img src="images/noimage.jpg" /></a>';
        }
        else {
            // Check if is in database
            list($compare_title, $issue) = explode("#", $c['title']);
            $alreadyindb = 0;

            foreach($rows as $r) {
                $compare_str = $r["title"] . "#" . $r["issue"];
                if($compare_str == $c['title']) {
                    if($r["woh"] == "have") {
                        echo '<a href="' .$c["img-big"] . '" data-lightbox="image" data-imgsmall="' . $c["img-small"] . '" data-title="' . $c["title"] .'" class="mytooltip img-item" data-toggle="tooltip" data-placement="top" title="' . $c["title"] . '"><img src="' . $c["img-small"] . '" /><span class="item-want"><span class="glyphicon glyphicon-eye-open"></span></span><span class="item-have" style="color:#00ff00"><span class="glyphicon glyphicon-ok"></span></span><span class="item-buy" data-url="' . $url . '&AffID=1090925P01"><span class="glyphicon glyphicon-usd"></span></span></a>';
                        $alreadyindb = 1;
                    }
                    else {
                        echo '<a href="' .$c["img-big"] . '" data-lightbox="image" data-imgsmall="' . $c["img-small"] . '" data-title="' . $c["title"] .'" class="mytooltip img-item" data-toggle="tooltip" data-placement="top" title="' . $c["title"] . '"><img src="' . $c["img-small"] . '" /><span style="color:#00ff00;" class="item-want"><span class="glyphicon glyphicon-eye-open"></span></span><span class="item-have"><span class="glyphicon glyphicon-ok"></span></span><span class="item-buy" data-url="' . $url . '&AffID=1090925P01"><span class="glyphicon glyphicon-usd"></span></span></a>';
                        $alreadyindb = 1;
                    }
                }
            }
            if($alreadyindb == 1) {
                $alreadyindb = 0;
            }
            else {
                echo '<a href="' .$c["img-big"] . '" data-lightbox="image" data-imgsmall="' . $c["img-small"] . '" data-title="' . $c["title"] .'" class="mytooltip img-item" data-toggle="tooltip" data-placement="top" title="' . $c["title"] . '"><img src="' . $c["img-small"] . '" /><span class="item-want"><span class="glyphicon glyphicon-eye-open"></span></span><span class="item-have"><span class="glyphicon glyphicon-ok"></span></span><span class="item-buy" data-url="' . $url . '&AffID=1090925P01"><span class="glyphicon glyphicon-usd"></span></span></a>';

            }
        }
    }
    // Print links to all pages
    print("<br><br>");
    if(!empty($pages) && is_numeric($pages) && $pages < 100) {
        print("Pages: ");
        for($i = 1; $i <= $pages; $i++) {
            if(isset($page) && $page == $i) {
                echo " $i ";
            }
            else if($i == 1 && !isset($page)) {
                echo " $i ";
            }
            else {
                echo "<a href=\"#\" class=\"page\" data-page=\"" . $i . "\"> [$i] </a>";
            }
        }
        echo "<br />";
    }
    else {
        print("Pages: ");
        echo "<a href=\"#\" class=\"page\" data-page=\"1\"> [1] </a>";
        echo "<br />";
    }
    echo '
        <script>
            $(".mytooltip").tooltip({
                animation: "true"
            });
        </script>
    ';

    unlink($myfile);

?>
