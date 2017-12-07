function searchmcsh(page) {

    var sterm = $('#mcsh-search-text').val();
    var dsel = $('#date-select').val();
    sterm = encodeURIComponent(sterm);
    dsel = encodeURIComponent(dsel);

    if(sterm.length == 0) {
        searchWarning("Please type a search term.");
        return false;
    }   
    else if(sterm.length < 4) {
        searchWarning("Search term is too short.");
        return false;
    }
    else {
        showInfo("Searching ... <img style=\"height: 34px; margin-left:30px;margin-top:-10px;\"src=\"images/loading.gif\" />");
        $('.mysubmitbutton').attr('disabled', 'disabled');
        $.get("/search.php?s=" + sterm + "&date=" + dsel + "&p=" + page, function(data) {
            if(data == "false") {
                searchWarning("Something went terribly wrong.");
                $('.mysubmitbutton').removeAttr('disabled');
            }
            else if(data == "tooshort") {
                searchWarning("Search term is too short.");
                $('.mysubmitbutton').removeAttr('disabled');
            }
            else if(data == "nothingthere") {
                searchWarning("There's nothing there :-/");
                $('.mysubmitbutton').removeAttr('disabled');
            }
            else if(data == "illegal") {
                searchWarning("Illegal characters.");
                $('.mysubmitbutton').removeAttr('disabled');
            }
            else if(data == "ERROR") {
                searchWarning("An error occured. Try again.");
                $('.mysubmitbutton').removeAttr('disabled');
            }
            else if(data == "NORESULTS") {
                searchWarning("This happens. Wait a moment and try again .. maybe check your search term.");
                $('.mysubmitbutton').removeAttr('disabled');
            }
            else {
                hideInfo();
                $('#search-results').html(data);
            }
        })
        .always(function() {
            $('.mysubmitbutton').removeAttr('disabled');
        })
    }
}

var s_timeout;
function searchWarning(text) {
    clearTimeout(s_timeout);
    $('#search-warnings').css("opacity", "1");
    $('#search-warnings').html("<span class=\"glyphicon glyphicon-remove\"></span>" + text);
    s_timeout = setTimeout("closeWarning()", 4000);
    return false;
}
function showInfo(text) {
    $('#search-warnings').css("opacity", "1");
    $('#search-warnings').html("<span style=\"color:#333\" class=\"glyphicon glyphicon-ok\"></span><span style=\"color: #333\">" + text + "</span>");
}
function hideInfo() {
    $('#search-warnings').animate({opacity: "0"}, 2000);
}


function closeWarning() {
    $('#search-warnings').animate({opacity: 0}, 500);
}


$(document).ready(function() {

    /* Chevron up down **/
    var sbu_clicked = false;
    $(".searchBarUp").on("click", function(e) {
        if(sbu_clicked === false) {
            /*$(".search-bg").animate({"margin-top" : "-97px", "opacity" : 0.2}, 300);*/
            $(".search-bg").addClass("search-bg-toggle");
            $(".searchBarUp").addClass("searchBarUp-toggle");
            $(".navbar-default").animate({"margin-top" : "-89px"}, 300);
            setTimeout(function() {
                $(".mylogo img").animate({"margin-top" : "89px"}, 500);
            }, 500);
            $(this).html('<span class="glyphicon glyphicon-chevron-down"></span>');
            sbu_clicked = true;
            e.preventDefault();
        }
        else {
            /*$(".search-bg").animate({"margin-top" : "42px", "opacity" : 1}, 300);*/
            $(".search-bg").removeClass("search-bg-toggle");
            $(".searchBarUp").removeClass("searchBarUp-toggle");
            $(".navbar-default").animate({"margin-top" : "0px"}, 300);
            $(".mylogo img").animate({"margin-top" : "0px"}, 300);
            $(this).html('<span class="glyphicon glyphicon-chevron-up"></span>');
            sbu_clicked = false;
            e.preventDefault();
        }

    });

    var wh = window.innerHeight;
    $(".middle").css("minHeight", wh);
    $('body').on('click', '.page', function(event) {
        event.preventDefault();
        var p = $(this);
        var cp = p.data("page");
        searchmcsh(cp);
    });

    $('body').on('click', '.item-want', function(event) {
        event.preventDefault();
        $(this).parent().children('.item-have').css("color", "#428bca");
        $(this).parent().children('.item-want').css("color", "#00ff00");
        var p = $(this).parent();
        var w_data = encodeURIComponent(p.data("title"));
        var w_imgsmall = encodeURIComponent(p.data("imgsmall"));
        var w_imgbig = encodeURIComponent(p.attr("href"));

        showInfo("Added " + p.data("title") + " to your want list.");
        $.get("/mcbcdb.php?title=" + w_data + "&imgsmall=" + w_imgsmall + "&imgbig=" + w_imgbig + "&item=want", function(data) {
        })
        .always(function() {
            setTimeout("hideInfo()", 2000);  
        });
        return false;
    });
    $('body').on('click', '.item-have', function(event) {
        event.preventDefault();
        $(this).parent().children('.item-want').css("color", "#428bca");
        $(this).parent().children('.item-have').css("color", "#00ff00");
        var p = $(this).parent();
        var w_data = encodeURIComponent(p.data("title"));
        var w_imgsmall = encodeURIComponent(p.data("imgsmall"));
        var w_imgbig = encodeURIComponent(p.attr("href"));

        showInfo("Added " + p.data("title") + " to your have list.");
        $.get("/mcbcdb.php?title=" + w_data + "&imgsmall=" + w_imgsmall + "&imgbig=" + w_imgbig + "&item=have", function(data) {
        })
        .always(function() {
            setTimeout("hideInfo()", 2000);
        });
        return false;
    });
    $('body').on('click', '.item-buy', function(event) {
        event.preventDefault();
        var u = $(this);
        var murl = u.data("url");
        var win = window.open(murl, '_blank');
        win.focus();
        return false;
    });
    $('body').on('click', '.my-glyphicon-remove', function() {
        $(this).parent().remove();
        var title = $(this).parent().data("title");
        var issue = $(this).parent(). data("issue");
        $.get("/deletefromdb.php?title=" + title + "&issue=" + issue, function(data) {
            if(data == "ERROR") {
                alert("Error deleting from db");
            }
        });
    });
    $('body').on('click', '.my-glyphicon-buy', function() {
        var t = $(this).parents("li");
        var title = t.data("title");
        var i = t.data("issue");
        if(/[^\.\d]/.test(i)) {
            i = i.replace(/\D/g,'');
        }
        var ftitle = title.split(/\(/);
        var url = "http://mycomicshop.com/search?q=" + ftitle[0] + "+" + i + "&AffID=1090925P01";
        window.open(url, "_blank");
    });
    
    $('body').on('click', '.my-glyphicon-ok', function() {
        var t = $(this).parents("li");
        var title = t.data("title");
        var i = "#" + t.data("issue");
        var imgbig = t.data("imgbig");
        var imgsmall = t.data("imgsmall");
        $(this).parent().remove();
        title = title + i;
        title = encodeURIComponent(title);
        imgbig = encodeURIComponent(imgbig);
        imgsmall = encodeURIComponent(imgsmall);
        $.get("mcbcdb.php?title=" + title + "&imgbig=" + imgbig + "&imgsmall=" + imgsmall + "&item=have", function(data) {
        });
    });

    $('body').on('click', '#ewlbtn', function() {
        $.get("delstuff.php?action=ewl", function(data) {
            $("#ewl_label").text("Deleted want list.");
        });
    });
    $('body').on('click', '#ehlbtn', function() {
        $.get("delstuff.php?action=ehl", function(data) {
            $("#ehl_label").text("Deleted have list.");
        });
    });
    $('body').on('click', '#delaccbtn', function() {
        $.get("delstuff.php?action=delacc", function(data) {
            $("#del_label").text(data);
            setTimeout(function() {
                window.location.href = "/";
            }, 3000);
        });
    });
    $('body').on('click', ".sd_button", function() {
        if($('.del_div').is(":hidden")) {
            $(".del_div").slideDown("slow");
        }
        else {
            $(".del_div").slideUp("slow");
        }
    });

    $('body').on('click', '.pw_button', function() {
        if($('.pw_div').is(":hidden")) {
            $(".pw_div").slideDown("slow");
        }
        else {
            $(".pw_div").slideUp("slow");
        }
    });
    $('body').on('click', '.ewl_button', function() {
        if($('.ewl_div').is(":hidden")) {
            $(".ewl_div").slideDown("slow");
        }
        else {
            $(".ewl_div").slideUp("slow");
        }
    });
    $('body').on('click', '.ehl_button', function() {
        if($('.ehl_div').is(":hidden")) {
            $(".ehl_div").slideDown("slow");
        }
        else {
            $(".ehl_div").slideUp("slow");
        }
    });
});

function ch_pw() {
    var oldpwd = $("#old_pwd").val();
    var new_pwd = $("#new_pwd").val();
    var new_pwd_conf = $("#new_pwd_conf").val();

    if(new_pwd != new_pwd_conf) {
        $("#pw_label").text("Passwords don't match.");
        return false;
    }
    else if(new_pwd == "") {
        $("#pw_label").text("Please type a new password.");
        return false;
    }
    else {
        $.get("chpwd.php?newpwd=" + new_pwd + "&oldpwd=" + oldpwd, function(data) {
            $("#pw_label").text(data);
            $("#old_pwd").val("");
            $("#new_pwd").val("");
            $("#new_pwd_conf").val("");
        });
    }

}


$(document).ready(function() {
    $("#ts").keyup(function() {
        search_title();
    });
});


function search_title() {
    var sterm = $('#ts').val();
    $(".li_title").each(function(index) {
        var title = $(this).text();
        var pattern = new RegExp(sterm, "i");
        if(sterm) {
            if(pattern.test(title)) {
            }
            else {
                $(this).parent().css("display", "none");
            }
        }
        else {
            $(this).parent().css("display", "block");
        }
    });
}

function middle_h() {
    var wh = window.innerHeight;
    wh -= 60;
    $('.middle').css("height", wh);
}
