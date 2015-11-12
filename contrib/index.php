<?php
// and here we need

// a list of all the matches and their scores
// add a match result?
// current and final team standings

?>

<html>
<head>
		<title>Contribution Leaderboard</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.css"/>
	<link href="../jquery.growl.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../common.css"/>
</head>
<body>
	<div class="container">
		<?php include("../topbar.php"); ?>

	<h1 class="page-header">Contribution Leaderboard - FTCList</h1>

	<p class="lead" style="font-weight: 400;">
		Contribution Points are awarded to teams that input competition data into the FTCList database.
		<ul>
			<li>Signing up to FTCList <strong>(10 Points)</strong></li>
			<li>Inputting a match into the database <strong>(3 Points)</strong></li>
			<li>Validating a matches scores <strong>(2 Points)</strong></li>
		</ul>
	</p>
	<div class="row">
		<div class="col-md-12">	
			<div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">
    					Matches
    				</h3>
  				</div>
  				<div class="panel-body">
  					<table id="contrib" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Team Number</th>
								<th>Team Name</th>
								<th>Points</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
  				</div>
			</div>
		</div>
	</div>


<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../jquery.growl.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
<script src="../common.js"></script>


<script>

jQuery.extend({
    highlight: function (node, re, nodeName, className) {
        if (node.nodeType === 3) {
            var match = node.data.match(re);
            if (match) {
                var highlight = document.createElement(nodeName || 'span');
                highlight.className = className || 'highlight';
                var wordNode = node.splitText(match.index);
                wordNode.splitText(match[0].length);
                var wordClone = wordNode.cloneNode(true);
                highlight.appendChild(wordClone);
                wordNode.parentNode.replaceChild(highlight, wordNode);
                return 1; //skip added node in parent
            }
        } else if ((node.nodeType === 1 && node.childNodes) && // only element nodes that have children
                !/(script|style)/i.test(node.tagName) && // ignore script and style nodes
                !(node.tagName === nodeName.toUpperCase() && node.className === className)) { // skip if already highlighted
            for (var i = 0; i < node.childNodes.length; i++) {
                i += jQuery.highlight(node.childNodes[i], re, nodeName, className);
            }
        }
        return 0;
    }
});

jQuery.fn.unhighlight = function (options) {
    var settings = { className: 'highlight', element: 'span' };
    jQuery.extend(settings, options);

    return this.find(settings.element + "." + settings.className).each(function () {
        var parent = this.parentNode;
        parent.replaceChild(this.firstChild, this);
        parent.normalize();
    }).end();
};

jQuery.fn.highlight = function (words, options) {
    var settings = { className: 'highlight', element: 'span', caseSensitive: false, wordsOnly: false };
    jQuery.extend(settings, options);
    
    if (words.constructor === String) {
        words = [words];
    }
    words = jQuery.grep(words, function(word, i){
      return word != '';
    });
    words = jQuery.map(words, function(word, i) {
      return word.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    });
    if (words.length == 0) { return this; };

    var flag = settings.caseSensitive ? "" : "i";
    var pattern = "(" + words.join("|") + ")";
    if (settings.wordsOnly) {
        pattern = "\\b" + pattern + "\\b";
    }
    var re = new RegExp(pattern, flag);
    
    return this.each(function () {
        jQuery.highlight(this, re, settings.element, settings.className);
    });
};


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


$("document").ready(function() {
	$.getJSON("./data/contrib.json", function(contrib) {
		var tbl = "";

		var list = [];
		for(var key in contrib.teams)
		{
			contrib.teams[key].num = key;
			list.push(contrib.teams[key]);
		}

		for(var i=1;i<list.length;i++)
		{
			var j=i;
			while(j>0 && list[j-1].pts < list[j].pts)
			{
				var tmp = list[j-1];
				list[j-1] = list[j];
				list[j] = tmp;
				j--;
			}
		}

		var cntr = 1;
		for(var i=0;i<list.length;i++)
		{
			if(getcookie("team") == list[i].num) tbl += "<tr class='info'>";
			else tbl += "<tr clas='info'>";
			tbl += "<td>"+cntr+"</td>";
			tbl += "<td><a href='../team?"+list[i].num+"'>"+xss(list[i].num)+"</a></td>";
			tbl += "<td>"+xss(list[i].name)+"</td>";
			tbl += "<td>"+xss(list[i].pts)+"</td>";
			tbl += "</tr>";
			cntr ++;
		}

			$("#contrib tbody").empty().append(tbl);

			var rows = $("#contrib").DataTable();

			rows.on( 'draw', function () {
        		var body = $(rows.table().body());
 
        		body.unhighlight();
        		body.highlight( rows.search() );  
    		});

			$('div.dataTables_filter label').contents().filter(function() { return this.nodeType == 3; }).remove();
    		$('div.dataTables_filter input').addClass('form-control').attr("placeholder", "Search Table").css("font-weight", "400");

	})
})

</script>
</body>

</html>