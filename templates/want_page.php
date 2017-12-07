    <div class="search-bg">
    <div class="search_title titles">
        <form onsubmit="search_title();return false;" class="form-inline" role="search">
            <label class="wohh1"><span class="glyphicon glyphicon-eye-open h1want"></span>Want List</label>
            <div class="input-group">
                <input class="form-control" id="ts" placeholder="Filter" type="text">
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" >
                </span>
                <span class="input-group-btn">
                    <a href="#" class="searchBarUp"><span class="glyphicon glyphicon-chevron-up"></span></a>
                </span>
            </div>
        </form>
        <p class="text-danger" id="search-warnings">&nbsp;</p>
    </div>
    </div>

    <div class="separator">
    </div>

    <div class="titles ul-top">

<?php
    if(!isset($dbstuff)) {
        exit;
    }


    $titles = array(array());
    $t_count = 0;

    foreach($dbstuff as $row) {
        $imgs_big[$t_count] = $row["imgbig"];
        $imgs_small[$t_count] = $row["imgsmall"];
        $titles[$row["title"]][$t_count] = $row["issue"];
        $t_count++;
    }

    //print_r($titles);
    $t_count = 0;
    foreach($titles as $t => $value) {
        if($t !== 0) {
            echo "<ul class=\"parentul\"><li class=\"li_title\">" . $t . "</li><ul class=\"childul\">";
            foreach($titles[$t] as $iss) {
                echo "<li data-title=\"$t\" data-issue=\"$iss\" data-imgsmall=\"" . $imgs_small[$t_count] . "\" data-imgbig=\"" . $imgs_big[$t_count] . "\">" . "<a href=\"" . $imgs_big[$t_count] . "\" data-lightbox=\"$t\" title=\"$t #$iss\">" . $iss . "</a><span style=\"float:right\" class=\"my-glyphicon-buy glyphicon glyphicon-usd\"></span><span style=\"float:right;\"class=\"my-glyphicon-remove glyphicon glyphicon-remove\"></span><span style=\"float:right;\" class=\"my-glyphicon-ok glyphicon glyphicon-ok\"></span></li>";
                $t_count++;
            }
            echo "</ul></ul>";
        }
    }

    echo '
        <script>
            $(".parentul li").click(function() {
                $(this).nextAll("ul").first().toggleClass("childul-vis");
            });
        </script>
    ';
?>

    </div><!-- titles end -->
