<?php
// and here we need

// a list of all the matches and their scores
// add a match result?
// current and final team standings

?>

<html>
<head>
		<title>Comp - COMPNAME</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.css"/>
	<link rel="stylesheet" href="../common.css"/>
</head>
<body>
	<div class="container">
		<?php include("../topbar.php"); ?>

	<h1 class="page-header">Comp - </h1>

	<div class="row">

		<div class="col-md-6">	
			<div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">
    					Matches
    					<button class="pull-right btn btn-xs btn-default" data-toggle="modal" data-target="#modal_match">Add Match</button>
    				</h3>
  				</div>
  				<div class="panel-body">
  					<table id="rows" class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Red</th>
								<th>Red</th>
								<th>Score</th>
								<th>Blue</th>
								<th>Blue</th>
								<th>Score</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
  				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">
    					Teams
    				</h3>
  				</div>
  				<div class="panel-body">
					<table id="teams" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Team</th>
								<th>QP</th>
								<th>RP</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="modal_match">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Add Match</h4>
      			</div>
      			<div class="modal-body">
        			<form method="POST" action="../addrow.php">
        				<input class="form-control" type="text" name="match" placeholder="Match number">
						<br/><input type='hidden' name='comp' id="comp">
						<label>Blue Alliance</label>
						<div class="row">
							<div class="col-md-4">
								<input class="form-control" type="text" name="blue1" placeholder="Team Number">
							</div>
							<div class="col-md-4">
								<input class="form-control" type="text" name="blue2" placeholder="Team Number">
							</div>
							<div class="col-md-4">
								<input class="form-control" type="text" name="bluescore" placeholder="Score"><br/>
							</div>
						</div>

						<label>Red Alliance</label>
						<div class="row">
							<div class="col-md-4">
								<input class="form-control" type="text" name="red1" placeholder="Team Number">
							</div>
							<div class="col-md-4">
								<input class="form-control" type="text" name="red2" placeholder="Team Number">
							</div>
							<div class="col-md-4">
								<input class="form-control" type="text" name="redscore" placeholder="Score"><br/>
							</div>
						</div>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary">Add Match</button>
					</form>
      			</div>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
<script src="../common.js"></script>


<script>

// highlight plugin
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

		function comp()
		{
			return window.location.search.substring(1);
		}

		function setrows(rows)
		{
			var tbl = "";
			var tlb = "";
			var teams = {};
			for(var a=0;a<rows.length;a++)
			{
				tbl += "<tr>";
				tbl += "<td>"+rows[a].match+"</td>";
				tbl += "<td class='danger'>"+rows[a].red1+"</td>";
				tbl += "<td class='danger'>"+rows[a].red2+"</td>";
				tbl += "<td class='danger'>"+rows[a].redscore+"</td>";
				tbl += "<td class='info'>"+rows[a].blue1+"</td>";
				tbl += "<td class='info'>"+rows[a].blue2+"</td>";
				tbl += "<td class='info'>"+rows[a].bluescore+"</td>";
				tbl += "</tr>";

				if(teams[rows[a].red1] == undefined)
				{
					teams[rows[a].red1] = {};
					teams[rows[a].red1].score = 0;
					teams[rows[a].red1].qp = 0;
					teams[rows[a].red1].rp = 0;
					teams[rows[a].red1].jp = 0;
					teams[rows[a].red1].alliance = [];

				}
				teams[rows[a].red1].score += Number(rows[a].redscore);
				teams[rows[a].red1].rp += Number(rows[a].bluescore);
				teams[rows[a].red1].alliance.push(rows[a].red2);

				if(teams[rows[a].red2] == undefined)
				{
					teams[rows[a].red2] = {};
					teams[rows[a].red2].score = 0;
					teams[rows[a].red2].qp = 0;
					teams[rows[a].red2].rp = 0;
					teams[rows[a].red1].jp = 0;
					teams[rows[a].red2].alliance = [];

				}
				teams[rows[a].red2].score += Number(rows[a].redscore);
				teams[rows[a].red2].rp += Number(rows[a].bluescore);
				teams[rows[a].red2].alliance.push(rows[a].red1);

				if(teams[rows[a].blue1] == undefined)
				{
					teams[rows[a].blue1] = {};
					teams[rows[a].blue1].score = 0;
					teams[rows[a].blue1].qp = 0;
					teams[rows[a].blue1].rp = 0;
					teams[rows[a].blue1].jp = 0;
					teams[rows[a].blue1].alliance = [];
				}
				teams[rows[a].blue1].score += Number(rows[a].bluescore);
				teams[rows[a].blue1].rp += Number(rows[a].redscore);
				teams[rows[a].blue1].alliance.push(rows[a].blue2);

				if(teams[rows[a].blue2] == undefined)
				{
					teams[rows[a].blue2] = {};
					teams[rows[a].blue2].score = 0;
					teams[rows[a].blue2].qp = 0;
					teams[rows[a].blue2].rp = 0;
					teams[rows[a].blue2].jp = 0;
					teams[rows[a].blue2].alliance = [];
				}
				teams[rows[a].blue2].score += Number(rows[a].bluescore);
				teams[rows[a].blue2].rp += Number(rows[a].redscore);
				teams[rows[a].blue2].alliance.push(rows[a].blue1);

				if(rows[a].bluescore > rows[a].redscore)
				{
					teams[rows[a].blue1].qp += 2;
					teams[rows[a].blue2].qp += 2;
				}
				else if(rows[a].bluescore < rows[a].redscore)
				{
					teams[rows[a].red1].qp += 2;
					teams[rows[a].red2].qp += 2;
				}
				else
				{
					teams[rows[a].red1].qp ++;
					teams[rows[a].red2].qp ++;
					teams[rows[a].blue1].qp ++;
					teams[rows[a].blue2].qp ++;
				}

			}

			var min = 999999999;
			var max = 0;
			for(var key in teams)
			{
				if(teams[key].score < min) min = teams[key].score;
				if(teams[key].score > max) max = teams[key].score;
			}

			var spread = (max - min);
			var midzone = spread/2;

			var sensitivity = 2;
			console.log("A"+2*sigmoid(4)+" "+2*sigmoid(-4));

			for(var key in teams)
			{
				var totw = 0;
				console.log(teams[key].score);
				for(var a=0;a<teams[key].alliance.length;a++)
				{
					var alscore = teams[teams[key].alliance[a]].score;
					var weight = sigmoid(((alscore - min) - midzone)*sensitivity/midzone);
					totw += weight;
				}

				totw /= teams[key].alliance.length;
				teams[key].totw = totw;
				teams[key].jp = (teams[key].score*totw)/teams[key].alliance.length;
				console.log(teams[key].jp);
			}


			for(var key in teams)
			{
				tlb += "<tr>";
				tlb += "<td>"+key+"</td>";
				tlb += "<td>"+teams[key].qp+"</td>";
				tlb += "<td>"+teams[key].rp+"</td>";
				//tlb += "<td>"+teams[key].score+"</td>";
				//tlb += "<td>"+Math.round(teams[key].jp)+"</td>";
				//tlb += "<td>"+teams[key].totw+"</td>";
				tlb += "</tr>";
			}

			// ok so how do I calc the jp

			$("#rows tbody").empty().append(tbl);
			$("#teams tbody").empty().append(tlb);

			var rows = $("#rows").DataTable({
				paging: false,
				info: false});

			rows.on( 'draw', function () {
        		var body = $( rows.table().body() );
 
        		body.unhighlight();
        		body.highlight( rows.search() );  
    		});

			var teams = $("#teams").DataTable({
				paging: false,
				info: false});

			teams.on( 'draw', function () {
        		var body = $( teams.table().body() );
 
        		body.unhighlight();
        		body.highlight( teams.search() );  
    		});

		}

		$("document").ready(function() {

			$("#comp").attr("value", comp());
			$.getJSON("../data/comps/"+comp()+".json", function(data) {
				$("h1").text(data.name+", "+data.date);
				setrows(data.rows);
		
			})
		})

		function sigmoid(x)
		{
			return 1/(1+(Math.pow(2.71828, -x)));
		}

	</script>



</body>
</html>