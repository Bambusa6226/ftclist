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
	<link href="../jquery.growl.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../common.css"/>
</head>
<body>
	<div class="container">
		<?php include("../topbar.php"); ?>

	<h1 class="page-header">Comp - </h1>

	<div class="row">
		<div class="col-md-12">	
			<div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">
    					About
    				</h3>
  				</div>
  				<div class="panel-body">
  					<dl id="aboutlist">
	  					<div class="row">
                            <div class="col-md-6">
			  					<dt>Date</dt>
                                <dd id="date"></dd>

			  			        <dt>Location</dt>
			  			        <dd id="location"></dd>

                                <dt>Unconfirmed Matches</dt>
                                <dd id="unconfs"></dd>
			  			    </div>
			  			    <div class="col-md-6">
			  			        <dt>Region</dt>
                                <dd id="region"></dd>

                                <dt>Competition Type</dt>
                                <dd id="type"></dd>
			  			    </div>
			  			</div>
	  	            </dl>
	  	           
  				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">	
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
							 <div class="help-block">
			  	            	* Surrogate match, score does not count for this team.<br/>
			  	            	(penalty points added to this teams score in parenthesis)
			  	            </div>
		  				</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
		  				<div class="panel-heading">
		    				<h3 class="panel-title">
		    					Score Spread
		    				</h3>
		  				</div>
		  				<div class="panel-body">
		  					<svg id="spread" style="width: 100%;">
		  						<text font-size="11px" x="10" y="11">frequency</text>
		  						<g id="axis">
		  						</g>
		  					</svg>
		  				</div>
		  			</div>
		  		</div>
	  		</div>
  		</div>

  		<div class="col-md-6">
  			<div class="row">
				<div class="col-md-12">
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
										<th>Matches</th>
										<th>QP</th>
										<th>RP</th>
										<th>Reliability <span id="aboutr" class='glyphicon glyphicon-question-sign' data-toggle="popover" title="Reliability Index" data-content="This is a measure of how reliably a team can score points in a match when their alliance partner is factored out. <a href='../jri.pdf'>Learn More</a>" data-placement="top" data-html='true'></span></th>
										<!--<th>avg</th>
										<th>dev</th>
										<th>weight</th>-->
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<div class="help-block">* Reliability index requires a team to have at least two matches in the competition.</div>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="col-md-12">
	  			<div class="panel panel-default">
	  				<div class="panel-heading">
	  					<h3 class="panel-title">
	  						Message Board
	  						<button class="pull-right btn btn-xs btn-default" data-toggle="modal" data-target="#modal_match">Add Message</button>
	  					</h3>
	  				</div>
	  				<div class="panel-body">
	  					<div class="msg">
	  						<div class="msgteam">
	  							6226 - Bambusa
	  						</div>
	  						<div class="msgtext">
	  							this is message, it is here...
	  						</div>
	  					</div>
	  				</div>
	  			</div>
	  		</div>-->
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
							<div class="col-md-3">
								<input class="form-control" type="text" name="blue1" placeholder="Team Number">
							</div>
							<div class="col-md-3">
								<input class="form-control" type="text" name="blue2" placeholder="Team Number">
							</div>
							<div class="col-md-3">
								<input class="form-control" type="text" name="bluescore" placeholder="Match Score"><br/>
							</div>
							<div class="col-md-3">
								<input class="form-control" type="text" name="bluepenalty" placeholder="Penalty Points"><br/>
							</div>
						</div>

						<label>Red Alliance</label>
						<div class="row">
							<div class="col-md-3">
								<input class="form-control" type="text" name="red1" placeholder="Team Number">
							</div>
							<div class="col-md-3">
								<input class="form-control" type="text" name="red2" placeholder="Team Number">
							</div>
							<div class="col-md-3">
								<input class="form-control" type="text" name="redscore" placeholder="Match Score"><br/>
							</div>
							<div class="col-md-3">
								<input class="form-control" type="text" name="redpenalty" placeholder="Penalty Points"><br/>
							</div>
						</div>
						<div class='help-block'>Surrogate Matches: Please put an asterisk (*) after the number of a team whos score doesn't count.</div>
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
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
<script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../jquery.growl.js" type="text/javascript"></script>
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


		var teamstbl, rowstbl;
		function setrows(rows)
		{
			var tbl = "";
			var tlb = "";
			var teams = {};

			for(var a=0;a<rows.length;a++)
			{
				// lets do some stuff here.

				tbl += "<tr>";
				tbl += "<td>"+xss(rows[a].match)+"</td>";
				if(Number(rows[a].redscore) > Number(rows[a].bluescore))
				{
					tbl += "<td class='redwin'>"+xss(rows[a].red1)+"</td>";
					tbl += "<td class='redwin'>"+xss(rows[a].red2)+"</td>";
					if(rows[a].redpenalty != undefined && rows[a].redpenalty != 0)
					{
						tbl += "<td class='redwin'>"+xss(rows[a].redscore+" ("+rows[a].redpenalty+")")+"</td>";
					}
					else
						tbl += "<td class='redwin'>"+xss(rows[a].redscore)+"</td>";
					tbl += "<td class='info'>"+xss(rows[a].blue1)+"</td>";
					tbl += "<td class='info'>"+xss(rows[a].blue2)+"</td>";
					if(rows[a].bluepenalty != undefined && rows[a].bluepenalty != 0)
					{
						tbl += "<td class='info'>"+xss(rows[a].bluescore+" ("+rows[a].bluepenalty+")")+"</td>";
					}
					else
						tbl += "<td class='info'>"+xss(rows[a].bluescore)+"</td>";
				}
				else if(Number(rows[a].redscore) < Number(rows[a].bluescore))
				{
					tbl += "<td class='danger'>"+xss(rows[a].red1)+"</td>";
					tbl += "<td class='danger'>"+xss(rows[a].red2)+"</td>";
					if(rows[a].redpenalty != undefined && rows[a].redpenalty != 0)
					{
						tbl += "<td class='danger'>"+xss(rows[a].redscore+" ("+rows[a].redpenalty+")")+"</td>";
					}
					else
						tbl += "<td class='danger'>"+xss(rows[a].redscore)+"</td>";
					tbl += "<td class='bluewin'>"+xss(rows[a].blue1)+"</td>";
					tbl += "<td class='bluewin'>"+xss(rows[a].blue2)+"</td>";
					if(rows[a].bluepenalty != undefined && rows[a].bluepenalty != 0)
					{
						tbl += "<td class='bluewin'>"+xss(rows[a].bluescore+" ("+rows[a].bluepenalty+")")+"</td>";
					}
					else
						tbl += "<td class='bluewin'>"+xss(rows[a].bluescore)+"</td>";
				}
				else
				{
					tbl += "<td class='redwin'>"+xss(rows[a].red1)+"</td>";
					tbl += "<td class='redwin'>"+xss(rows[a].red2)+"</td>";
					if(rows[a].redpenalty != undefined && rows[a].redpenalty != 0)
					{
						tbl += "<td class='redwin'>"+xss(rows[a].redscore+" ("+rows[a].redpenalty+")")+"</td>";
					}
					else
						tbl += "<td class='redwin'>"+xss(rows[a].redscore)+"</td>";
					tbl += "<td class='bluewin'>"+xss(rows[a].blue1)+"</td>";
					tbl += "<td class='bluewin'>"+xss(rows[a].blue2)+"</td>";
					if(rows[a].bluepenalty != undefined && rows[a].bluepenalty != 0)
					{
						tbl += "<td class='bluewin'>"+xss(rows[a].bluescore+" ("+rows[a].bluepenalty+")")+"</td>";
					}
					else
						tbl += "<td class='bluewin'>"+xss(rows[a].bluescore)+"</td>";
				}
				
				tbl += "</tr>";

				


				
				if(teams[rows[a].red1] == undefined)
				{
					teams[rows[a].red1] = {};
					teams[rows[a].red1].score = 0;
					teams[rows[a].red1].qp = 0;
					teams[rows[a].red1].rp = 0;
					teams[rows[a].red1].jp = 0;
					teams[rows[a].red1].alliance = [];
					teams[rows[a].red1].scores = [];
				}

				if(Number(rows[a].bluescore) < Number(rows[a].redscore))
				{
					teams[rows[a].red1].rp += Number(rows[a].bluescore);
					if(rows[a].bluepenalty != undefined) teams[rows[a].red1].rp -= Number(rows[a].bluepenalty);
				}
				else
				{
					teams[rows[a].red1].rp += Number(rows[a].redscore);
					if(rows[a].redpenalty != undefined) teams[rows[a].red1].rp -= Number(rows[a].redpenalty); 
				}

				if(rows[a].red1.indexOf("*") != -1)
				{
					rows[a].red1 = rows[a].red1.substring(0, rows[a].red1.length-1);
					console.log(rows[a].red1);
					if(teams[rows[a].red1] == undefined)
					{
						teams[rows[a].red1] = {};
						teams[rows[a].red1].score = 0;
						teams[rows[a].red1].qp = 0;
						teams[rows[a].red1].rp = 0;
						teams[rows[a].red1].jp = 0;
						teams[rows[a].red1].alliance = [];
						teams[rows[a].red1].scores = [];
					}
				}

				teams[rows[a].red1].score += Number(rows[a].redscore);
				if(rows[a].redpenalty != undefined) teams[rows[a].red1].score -= Number(rows[a].redpenalty);


				teams[rows[a].red1].scores.push(rows[a].redscore);
				teams[rows[a].red1].alliance.push(rows[a].red2);


				if(teams[rows[a].red2] == undefined)
				{
					teams[rows[a].red2] = {};
					teams[rows[a].red2].score = 0;
					teams[rows[a].red2].qp = 0;
					teams[rows[a].red2].rp = 0;
					teams[rows[a].red2].jp = 0;
					teams[rows[a].red2].alliance = [];
					teams[rows[a].red2].scores = []
				}

				

				if(Number(rows[a].bluescore) < Number(rows[a].redscore))
				{
					teams[rows[a].red2].rp += Number(rows[a].bluescore);
					if(rows[a].bluepenalty != undefined) teams[rows[a].red2].rp -= Number(rows[a].bluepenalty);
				}
				else
				{
					teams[rows[a].red2].rp += Number(rows[a].redscore);
					if(rows[a].redpenalty != undefined) teams[rows[a].red2].rp -= Number(rows[a].redpenalty); 
				}

				if(rows[a].red2.indexOf("*") != -1)
				{
					rows[a].red2 = rows[a].red2.substring(0, rows[a].red2.length-1);
					console.log(rows[a].red2);
					if(teams[rows[a].red2] == undefined)
					{
						teams[rows[a].red2] = {};
						teams[rows[a].red2].score = 0;
						teams[rows[a].red2].qp = 0;
						teams[rows[a].red2].rp = 0;
						teams[rows[a].red2].jp = 0;
						teams[rows[a].red2].alliance = [];
						teams[rows[a].red2].scores = [];
					}
				}

				teams[rows[a].red2].score += Number(rows[a].redscore);
				if(rows[a].redpenalty != undefined) teams[rows[a].red2].score -= Number(rows[a].redpenalty);

				teams[rows[a].red2].scores.push(rows[a].redscore);
				teams[rows[a].red2].alliance.push(rows[a].red1);


				if(teams[rows[a].blue1] == undefined)
				{
					teams[rows[a].blue1] = {};
					teams[rows[a].blue1].score = 0;
					teams[rows[a].blue1].qp = 0;
					teams[rows[a].blue1].rp = 0;
					teams[rows[a].blue1].jp = 0;
					teams[rows[a].blue1].alliance = [];
					teams[rows[a].blue1].scores = []
				}
				teams[rows[a].blue1].score += Number(rows[a].bluescore);
				if(rows[a].bluepenalty != undefined) teams[rows[a].blue1].score -= Number(rows[a].bluepenalty);

				if(Number(rows[a].bluescore) < Number(rows[a].redscore))
				{
					teams[rows[a].blue1].rp += Number(rows[a].bluescore);
					if(rows[a].bluepenalty != undefined) teams[rows[a].blue1].rp -= Number(rows[a].bluepenalty);
				}
				else
				{
					teams[rows[a].blue1].rp += Number(rows[a].redscore);
					if(rows[a].redpenalty != undefined) teams[rows[a].blue1].rp -= Number(rows[a].redpenalty); 
				}

				if(rows[a].blue1.indexOf("*") != -1)
				{
					rows[a].blue1 = rows[a].blue1.substring(0, rows[a].blue1.length-1);
					console.log(rows[a].blue1);
					if(teams[rows[a].blue1] == undefined)
					{
						teams[rows[a].blue1] = {};
						teams[rows[a].blue1].score = 0;
						teams[rows[a].blue1].qp = 0;
						teams[rows[a].blue1].rp = 0;
						teams[rows[a].blue1].jp = 0;
						teams[rows[a].blue1].alliance = [];
						teams[rows[a].blue1].scores = [];
					}
				}

				teams[rows[a].blue1].score += Number(rows[a].bluescore);
				if(rows[a].bluepenalty != undefined) teams[rows[a].blue1].score -= Number(rows[a].bluepenalty);

				teams[rows[a].blue1].scores.push(rows[a].bluescore);
				teams[rows[a].blue1].alliance.push(rows[a].blue2);

				if(teams[rows[a].blue2] == undefined)
				{
					teams[rows[a].blue2] = {};
					teams[rows[a].blue2].score = 0;
					teams[rows[a].blue2].qp = 0;
					teams[rows[a].blue2].rp = 0;
					teams[rows[a].blue2].jp = 0;
					teams[rows[a].blue2].alliance = [];
					teams[rows[a].blue2].scores = []
				}
				teams[rows[a].blue2].score += Number(rows[a].bluescore);
				if(rows[a].bluepenalty != undefined) teams[rows[a].blue2].score -= Number(rows[a].bluepenalty);

				if(Number(rows[a].bluescore) < Number(rows[a].redscore))
				{
					teams[rows[a].blue2].rp += Number(rows[a].bluescore);
					if(rows[a].bluepenalty != undefined) teams[rows[a].blue2].rp -= Number(rows[a].bluepenalty);
				}
				else
				{
					teams[rows[a].blue2].rp += Number(rows[a].redscore);
					if(rows[a].redpenalty != undefined) teams[rows[a].blue2].rp -= Number(rows[a].redpenalty); 
				}

				if(rows[a].blue2.indexOf("*") != -1)
				{
					rows[a].blue2 = rows[a].blue2.substring(0, rows[a].blue2.length-1);
					console.log(rows[a].blue2);
					if(teams[rows[a].blue2] == undefined)
					{
						teams[rows[a].blue2] = {};
						teams[rows[a].blue2].score = 0;
						teams[rows[a].blue2].qp = 0;
						teams[rows[a].blue2].rp = 0;
						teams[rows[a].blue2].jp = 0;
						teams[rows[a].blue2].alliance = [];
						teams[rows[a].blue2].scores = [];
					}
				}

				teams[rows[a].blue2].score += Number(rows[a].bluescore);
				if(rows[a].bluepenalty != undefined) teams[rows[a].blue2].score -= Number(rows[a].bluepenalty);

				teams[rows[a].blue2].scores.push(rows[a].bluescore);
				teams[rows[a].blue2].alliance.push(rows[a].blue1);

				if(parseInt(rows[a].bluescore) > parseInt(rows[a].redscore))
				{
					teams[rows[a].blue1].qp += 2;
					teams[rows[a].blue2].qp += 2;
				}
				else if(parseInt(rows[a].bluescore) < parseInt(rows[a].redscore))
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

			// its charting time
			var maxs = 0;
			var mins = 1000000000;

			for(var key in teams)
			{
				for(var i=0;i<teams[key].scores.length;i++)
				{
					if(parseInt(teams[key].scores[i]) > maxs) maxs = parseInt(teams[key].scores[i]);
					if(parseInt(teams[key].scores[i]) < mins) mins = parseInt(teams[key].scores[i]);
				}
			}

			var steps = 10;
			var spr = Math.ceil((maxs)/(steps));
			var amts = [];
			for(i=0;i<steps;i++) amts[i] = 0;
			for(var key in teams)
			{
				for(var i=0;i<teams[key].scores.length;i++)
				{
					amts[Math.floor(teams[key].scores[i]/spr)]+= 0.5;
				}
			}

			var maxrep = 0;
			for(var i=0;i<amts.length;i++)
			{
				if(amts[i] > maxrep) maxrep = amts[i];
			}

			var height = $("#spread").height();
			var hoffset = 30;
			var htick = (height-(hoffset*2))/maxrep;
			var width = $("#spread").width();
			var wtick = width/(steps+1);
			var woffset = Math.floor(wtick);

			d3.select("#axis").append("text")
			.text("score ranges")
			.attr("font-size", "11px")
			.attr("y", height-4)
			.attr("x", width/2-20);

			for(var i=0;i<maxrep+1;i++)
			{
				d3.select("#axis").append("line")
				.attr("y1", off(htick*i)+hoffset)
				.attr("y2", off(htick*i)+hoffset)
				.attr("x1", 0)
				.attr("x2", width)
				.attr("stroke", "black")
				.attr("stroke-width", "0.1");

				d3.select("#axis").append("text")
				.text(maxrep - i)
				.attr("y", off(htick*i)-2+hoffset)
				.attr("x", 20)
				.attr("font-size", "11px");
			}

			for(var i=0;i<steps;i++)
			{
				/*d3.select("#axis").append("line")
				.attr("x1", woffset+off(wtick*i))
				.attr("x2", woffset+off(wtick*i))
				.attr("y1", 0)
				.attr("y2", height)
				.attr("stroke", "black");*/

				d3.select("#axis").append("rect")
				.attr("fill", "dodgerblue")
				.attr("x", Math.floor(wtick*i)+woffset)
				.attr("width", Math.floor(wtick/2))
				.attr("y", Math.floor((height-hoffset)-(htick*(amts[i])))+1)
				.attr("height", Math.floor(htick*amts[i]));

				d3.select("#axis").append("text")
				.text(spr*i + "-" + (spr*(i+1)))
				.attr("y", height-hoffset+12)
				.attr("x", woffset+off(wtick*i))
				.attr("text-anchor", "center")
				.attr("font-size", "11px")
				.attr("width", wtick);

			}

			var min = 999999999;
			var max = 0;
			var favg = 0;
			var cnt = 0;

			for(var key in teams)
			{
				if(key.indexOf("*") != -1) continue;
				teams[key].avg = teams[key].score / teams[key].alliance.length;
				if(teams[key].avg < min) min = teams[key].avg;
				if(teams[key].avg > max) max = teams[key].avg;
				favg += teams[key].avg;
				console.log(key+ " "+ teams[key].avg)
				cnt++;
				teams[key].nummatch = teams[key].alliance.length;
			}
			favg /= cnt;

			console.log(favg);

			for(var key in teams)
			{
				sd = 0;
				for(var a=0;a<teams[key].alliance.length;a++)
				{
					sd += Math.pow((teams[key].scores[a]-teams[key].avg), 2);
				}
				teams[key].dv = Math.sqrt(sd/(teams[key].scores.length-1));
			}
			
			for(key in teams)
			{
				var err = 0;
				teams[key].errors = [];
				for(var a=0;a<teams[key].alliance.length;a++)
				{
					var er = teams[teams[key].alliance[a]].dv/(Math.sqrt(teams[key].nummatch)*teams[teams[key].alliance[a]].avg);
					teams[key].errors.push(er);
					err += 1/er;
				}
				teams[key].weight = 1/err;
				//teams[key].error = teams[key].dv/(Math.sqrt(teams[key].nummatch));
			}

			for(key in teams)
			{
				teams[key].adj = [];
				var counter = 0;
				for(var i=0; i < teams[key].alliance.length; i++)
				{
					console.log(favg)
					var sco = teams[key].scores[i]*sigmoid((teams[teams[key].alliance[i]].avg-favg)*1);
					counter += sco;
					teams[key].adj.push(sco);
				}
				teams[key].rel = Math.round(counter/teams[key].scores.length);

				var aavg = 0;

				var sd = 0;
				for(var i=0;i<teams[key].alliance.length;i++)
				{
					sd += Math.pow((teams[key].adj[a]-teams[key].rel), 2);
				}
				teams[key].error = 1.96*Math.sqrt(sd/(teams[key].scores.length-1))/Math.sqrt(teams[key].alliance.length);
				
			}
			

			for(var key in teams)
			{
				if(key.indexOf("*") != -1) continue;

				tlb += "<tr>";
				tlb += "<td> <a href='../team?"+xss(key)+"'>"+xss(key)+"</a></td>";
				tlb += "<td>"+teams[key].scores.length+"</td>";
				tlb += "<td>"+teams[key].qp+"</td>";
				tlb += "<td>"+teams[key].rp+"</td>";
				if(teams[key].scores.length == 1)
					tlb += "<td data-order='0'>0*</td>";
				else
					tlb += "<td data-order='"+teams[key].rel+"'>"+teams[key].rel+" ± "+Math.round(teams[key].error)+" </td>";

				//tlb += "<td>"+Math.round(teams[key].avg)+"</td>";
				//tlb += "<td>"+Math.round(teams[key].dv)+"</td>";
				//tlb += "<td>"+Math.round(teams[key].weight)+"</td>";

				//tlb += "<td>"+Math.round(teams[key].jp)+"</td>";
				//tlb += "<td>"+teams[key].totw+"</td>";
				tlb += "</tr>";
			}

			// ok so how do I calc the jp
			if(!fst)
			{
				teamstbl.destroy();
				rowstbl.destroy();
			}
			else
			{
				fst = false;
			}
				$("#rows tbody").empty().append(tbl);
				$("#teams tbody").empty().append(tlb);


				fst = false;
				rowstbl = $("#rows").DataTable();

				rowstbl.on( 'draw', function () {
	        		var body = $(rowstbl.table().body());
	 
	        		body.unhighlight();
	        		body.highlight( rowstbl.search() );  
	    		});

				teamstbl = $("#teams").DataTable({
					"order": [[ 2, 'desc' ], [ 3, 'desc' ]]
				});

				teamstbl.on( 'draw', function () {
	        		var body = $(teamstbl.table().body());

	        		body.unhighlight();
	        		body.highlight( teamstbl.search() );  
	    		});

				$('div.dataTables_filter label').contents().filter(function() { return this.nodeType == 3; }).remove();
	    		$('div.dataTables_filter input').addClass('form-control').attr("placeholder", "Search Table").css("font-weight", "400");
		}
		var fst = true;
		$("document").ready(function() {

			 $('[data-toggle="popover"]').popover()
			$("#spread").css("height", $("#spread").width());

			<?php if(isset($_POST['message'])) echo "Growl.growl({'title':'Action Successful','message':'".$_POST['message']."'});"; ?>

			$("#comp").attr("value", comp());
			$.getJSON("../data/comps/"+comp()+".json", function(data) {
				if(data.region != undefined) region = data.region.replace(" ", "").toLowerCase();
				else region = "";

				$("#location").text(data.place);
				$("#date").text(data.date);
				$("#region").html("<a href='../region?"+region+"'>"+xss(data.region)+"</a>");
				var type = data.type == "qual" ? "Qualifier" : data.type == "league" ? "League Meet" : data.type == "noncomp" ? "Practice/Scrimmage" : data.type == "region" ? "Regional" : type; 
				$("#type").text(type);
                
                rowsdata = data.rows;

                setrows(data.rows);
                
				unconfs();

				$("h1").text(data.name);
				$("title").text("Competition - "+data.name+" - FTCList");
				//setrows(data.rows);
		
			})
		});
        var rowsdata = [];
		var confs = [];

		function jspstep(team, teams, avg, depth)
		{
			var counter = 0;
			if(depth == 0) 
			{
				for(var i=0; i < teams[team].alliance.length; i++)
				{
					var msc = teams[team].scores[i] - (teams[teams[team].alliance[i]].avg/2);
					//msc *= teams[team].weight*(1/teams[team].errors[i]);

					counter += msc;
				}
				return counter/teams[team].scores.length;
			}

			for(var i=0; i < teams[team].alliance.length; i++)
			{
				var msc = teams[team].scores[i] - (teams[teams[team].alliance[i]].avg - (jspstep(teams[team].alliance[i], teams, avg, depth-1)/2));
				//msc *= teams[team].weight*(1/teams[team].errors[i]);

				counter += msc;
			}
			return counter/teams[team].scores.length;
		}

		function sigmoid(n)
		{
			console.log(n+ " " + 1/(1+Math.pow(2.71828, -n)));
			return 1/(1+Math.pow(2.71828, -n));
		}


		function unconfs() {
			$("#unconfs").text("No Unconfirmed Matches");
			$.getJSON("../data/unconf/"+comp()+".json",function(data) {
				var rem = [];
				var unc = "";
				var first = true;
				for(var i=0;i<data.rows.length;i++)
				{
					var broke = false;
					for(var j=0;j<data.confed.length;j++)
					{
						if(data.rows[i].match == data.confed[j]) broke = true;
					}
					if(!broke) 
					{
						if(!first) unc += ", ";
						else first = !first;
						unc += data.rows[i].match;
					}
				}
				if(unc == "") unc = "No Unconfirmed Matches";
				$("#unconfs").text(unc);
				console.log("rechecking");
                
                if(JSON.stringify(data.confed) != JSON.stringify(confs))
                {
                    confs = data.confed;
                    $.getJSON("../data/comps/"+comp()+".json", function(data) {
                    	setrows(data.rows);
                	})
                }
			});
		}

		function off(num)
		{
			return Math.floor(num)+0.5;
		}
    
        setInterval(unconfs, 10000);

	</script>
</body>
</html>