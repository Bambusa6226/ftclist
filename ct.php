<?php
	if(isset($_POST['longitude']))
	{

		$long = $_POST['longitude'];
		$lat = $_POST['latitude'];
		$time = $_POST['timestamp'];


		$newrow = new STDClass();
		$newrow->longitude = $long;
		$newrow->latitude = $lat;
		$newrow->timestamp = $time;

		file_put_contents("loc.json", json_encode($newrow));
		echo "New Position Saved.";
		die;
	}	
?>




<!DOCTYPE html>
<html>
<head>
	<title>Capture the Flag</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100' rel='stylesheet' type='text/css'>
	<script src="./jquery.js"></script>

	<script>

	var mpd = 68.91;

	$("document").ready(function() {

		navigator.geolocation.watchPosition(watch, function() {document.write("need location")});

		$("#reset").click(function() {
			navigator.geolocation.getCurrentPosition(
     			processGeolocation,
     			geolocationError,
     			{enableHighAccuracy: true}
     		);
		})


	});



function processGeolocation(position) {
	lat = position.coords.latitude;
	lon = position.coords.longitude;
	$.post("./ct.php", 
		{
			"latitude":position.coords.latitude,
			"longitude": position.coords.longitude,
			"timestamp": position.timestamp
		}
	, draw);
}

function watch(pos)
{
	var crd = pos.coords;
	rng = Math.random();
	$.getJSON("./loc.json?rng="+rng, function(resp)
	{
		// okay so now we have two coords to compare...

		var magx = resp.longitude-crd.longitude;
		var magy = resp.latitude-crd.latitude;
		var mag = Math.sqrt((magx*magx)+(magy*magy))*mpd;
		var dir = (180*Math.atan2(magy,magx))/Math.PI;

		if(dir < 0) dir += 360;
		
		$("#dist").text(mag.toFixed(1));
		if(dir > 0 && dir < 90)
		{
			$("#sig").text("N of E");
		}
		else if(dir < 180)
		{
			$("#sig").text("N of W");
			dir -= 90;
			dir = 90 - dir;
		}
		else if(dir < 270)
		{
			$("#sig").text("S of W");
			dir -= 180;
		}
		else if(dir < 360)
		{
			$("#sig").text("S of E");
			dir -= 270;
			dir = 90 - dir;
		}

		$("#dir").html(dir.toFixed(0)+"&deg;");

		$("#yours").text("("+crd.longitude+", "+crd.latitude+")");

		$("#targ").text("("+resp.longitude+", "+resp.latitude+")");

		$("#info").text("Its working.");

		console.log("updating");
	})

}

function draw(resp)
{
	$("#info").text(resp);

	/*resp = JSON.parse(resp);
	console.log(resp);
	$("#texts").empty();
	$("#points").empty();
	drawPoint(screen.width/2, screen.height/2, name);
	for(var a=0;a<resp.length;a++)
	{
		if(resp[a].name == name) continue;
		var magx = lon-resp[a].longitude;
		var magy = lat-resp[a].latitude;
		var mag = Math.sqrt((magx*magx)+(magy*magy));
		var dir = Math.atan(magy/magx);
		var xpos = (screen.width/2)+(Math.cos(dir)*100);
		var ypos = (screen.height/2)+(Math.sin(dir)*100);
		console.log(magx);
		console.log(magy);
		console.log((screen.width/2)-xpos);
		console.log((screen.height/2)-ypos);
		drawPoint(xpos, ypos, resp[a].name+"<br/>"+toDecimal((mag*mpd), 2)+" mi<br/>"+Math.round((unix()-(resp[a].timestamp/1000))/60)+" min");
	}*/
}


function geolocationError(error)
{
	console.log(error);
	document.write("ERR: "+JSON.stringify(error));
}


function drawPoint(xpos, ypos, data)
{
	d3.select("#points").append("circle").attr("cx", xpos).attr("cy", ypos).attr("r", 3).attr("fill", "black")
	$("#texts").append("<p style='position:absolute;left:"+(xpos-20)+"px;top:"+(ypos)+"px;'>"+data+"</p>");
}

function unix()
{
	return Math.floor(Date.now() / 1000)
}


function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function toDecimal(number, dec)
{
	number *= Math.pow(10, dec);
	number = Math.round(number);
	number /= Math.pow(10, dec);
	number = number.toString();
	if(number.indexOf(".") === -1 && dec != 0)
	{
		number += ".";
	}
	while(number.indexOf(".")+dec >= number.length) number += "0";
	if(number.indexOf(".")+dec > number.length) number = number.substring(0, number.indexOf(".")+dec);
	return number;
}


	</script>
	<style>
* {
	margin: 0;
	padding: 0;
	font-family: "Roboto", sans-serif;
}

svg {
	z-index: -2;
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

#texts {
	z-index: -1;
	position: absolute;
	top: 0;
	left: 0;
	text-align: center;
	width: 100%;
	height: 100%;
}

#texts p {
	position: absolute;
	padding: 0;
	margin: 0;
}

#svg {
}

#html {
	height: 100%;
}

div {
	text-align: center;
}

.page-header {
	text-align: left;
}

.stats {
	padding-top: 32px;
	height: 100%;
}

.num {
	margin-bottom: 0px;
	padding-bottom: 0px;
	font-size: 58px;
	font-weight: 100;
}
.des {
	margin-top: -14px;
	color: #000;
	font-size: 22px;
}


	</style>


</head>
<body>
	<div class="container">
		<h1 class="page-header">Car Tag Beta</h1>

		<div class="row">
			<div class="col-xs-12">
				<button id="reset" type="button" class="btn btn-primary btn-large btn-block">Set Position to Current Location</button>
			</div>
		</div>
		
		<div class="row stats">
			<div class="col-xs-6">
				<div class="num" id="dir">
					? &deg;
				</div>
				<div class="des" id="sig">
					? of ?
				</div>
			</div>
			<div class="col-xs-6">
				<div class="num" id="dist">
					?
				</div>
				<div class="des">
					Miles
				</div>
			</div>
		</div>

		<div class="row stats">
			<div class="col-xs-12">
				<div class="num" id="yours" style="font-size: 18pt;margin-bottom: 5px;">
					?
				</div>
				<div class="des">
					You
				</div>
			</div>
			<div class="col-xs-12">
				<div class="num" id="targ" style="font-size: 18pt;margin-bottom: 5px;">
					?
				</div>
				<div class="des">
					Target
				</div>
			</div>
		</div>

		<div class="row" style="position:absolute;bottom:18px;width:100%">
			<div class="col-xs-12">
				<div id="info" class="help-block">Loading position information ...</div>
			</div>
		</div>
	</div>

</body>
</html>