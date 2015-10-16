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


var base = "http://127.0.0.1/";
$("#navsearch").attr("action", base+"search");

if(getcookie("team") != null)
{
	$(".navbar-brand").attr("href", base+"team?"+getcookie("team"));
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