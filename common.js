	function readtop()
{
	return window.location.search.substring(1);
}

function setcookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function getcookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function xss(val)
{
    if(val == undefined) return undefined;
    if(typeof(val) != String) return val;
    return val.replace("&","&amp;").replace("<", "&lt;").replace(">","&gt;").replace('"', '&quot;').replace("'", "&#x27;").replace("/", "&#x2F;");
}

function trim(val, len)
{
    if(val.length <= len) return val;
    return xss("<span title='"+val+"'>"+val.slice(0, len)+"..</span>");
}

var base = "http://10.63.160.73/";
$("#navsearch").attr("action", base+"search");
$("#loginform").attr("action", base+"login.php");
$("#navregister").attr("href", base+"register");


$("body").append('<p style="text-align: center;color: #666">FTC Team <a href="'+base+'about">6226 Bambusa</a> &copy; Copyright 2015</p>');

if(getcookie("team") != null)
{
	$(".navbar-brand").attr("href", base);
	$("#navteam").text("Team " + getcookie("team"));
	$("#navteam").attr("href", base+"team?"+getcookie("team"));
	$("#navregion").text(getcookie("region").replace("+", " "));
	var region = getcookie("region").toLowerCase().replace("+", "").replace(" ", "");
	$("#navregion").attr("href", base+"region?"+region);
    $("#navlogout").attr("href", base+"logout.php");

}
else
{
	$(".navbar-brand").attr("href", "../");
	$("#navteam").css("display", "none");
	$("#navregion").css("display", "none");
	$("#navlogout").css("display", "none");
    $("#navlogin").css("display", "block");
    $("#navregister").css("display", "block");
}