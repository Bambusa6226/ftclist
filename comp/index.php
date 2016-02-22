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
		<div class="col-lg-12">	
			<div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">
    					About
    				</h3>
  				</div>
  				<div class="panel-body">
  					<dl id="aboutlist">
	  					<div class="row">
                            <div class="col-lg-6">
			  					<dt>Date</dt>
                                <dd id="date"></dd>

			  			        <dt>Location</dt>
			  			        <dd id="location"></dd>
			  			    </div>
			  			    <div class="col-lg-6">
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
		<div class="col-lg-7">
			<div class="row">
				<div class="col-lg-12">	
					<div class="panel panel-default">
		  				<div class="panel-heading">
		    				<h3 class="panel-title">
		    					Matches
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
										<th title='Simulated Win Percentage'><em>Sim. Win %</em></th>
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
				<div class="col-lg-12">
					<div class="panel panel-default">
		  				<div class="panel-heading">
		    				<h3 class="panel-title">
		    					Teams
		    				</h3>
		  				</div>
		  				<div class="panel-body">
							<table id="teams" class="display">
								<thead>
									<tr>
										<th>#</th>
										<th>Team</th>
										<th>Games</th>
										<th>QP</th>
										<th>RP</th>
										<th title='Jones Score Prediction'><em>JSP</em></th>
										<th title='Simulated QP'><em>Sim. QP</em></th>
										<th title='QP Difference'><em>QP Diff.</em></th>
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
			
  		</div>

  		<div class="col-lg-5">
  			<div class="row">
  				<div class="col-lg-12">
  					<div class="panel panel-default">
		  				<div class="panel-heading">
		    				<h3 class="panel-title">
		    					Add Match Data
		    				</h3>
		  				</div>
		  				<div class="panel-body">
		  					<!-- Nav tabs -->
						 	<ul class="nav nav-tabs" role="tablist" id="scoring">
						    	<li role="presentation" class="active"><a href="#tms" aria-controls="tms" role="tab" data-toggle="tab">Teams</a></li>
						    	<li role="presentation"><a href="#scores" aria-controls="scores" role="tab" data-toggle="tab">Scores</a></li>
						  	</ul><br/>

						  <!-- Tab panes -->
							<div class="tab-content">
							 	<div role="tabpanel" class="tab-pane active" id="tms">
							 		<form>
							    	<div class="row">
							    		<div class="col-md-8">
							    			<input tabindex="1" id="mnum" type='text' class="form-control" placeholder="Match Number" />
							    		</div>
							    		<div class="col-md-4">
							    			<button tabindex="6" id="msub" type='button' class='btn btn-primary btn-block'>Submit</button>
							    		</div>
							    	</div><hr/>
							    	<div class="row">
							    		<div class="col-md-5">
				  							<input tabindex="2" id="mrt1" type="text" class="form-control" placeholder="Red Team"/> <br/>
				  							<input tabindex="3" id="mrt2" type="text" class="form-control" placeholder="Red Team"/>
				  						</div>
				  						<div class="col-md-2">
				  							
				  							<div style="text-align:center;font-size: 14pt;margin-top: 30px;">VS</div>
				  						</div>
										<div class="col-md-5">
				  							<input tabindex="4" id="mbt1" type="text" class="form-control" placeholder="Blue Team"/> <br/>
				  							<input tabindex="5" id="mbt2" type="text" class="form-control" placeholder="Blue Team"/>
				  						</div>
							    	</div>
							    	<div class="tabblocker1" tabindex="6"></div>
							    	</form>
							    	<div class="help-block">
							    		Place an asterisk (*) after teams in surrogate matches.
							    	</div>
							    </div>
							    <div role="tabpanel" class="tab-pane" id="scores">
								 	<div class="form-horizontal">
									   	<div class='form-group'>
										 	<label for="smatchnum" class='control-label col-md-2'>Match</label>
									    	<div class="col-md-6">
										    	<select class="form-control" id="smatchnum">
										    		<option>1</option>
										    		<option>2</option>
										    	</select>
										    </div>
										    <div class="col-md-4">
										    	<button type="button" class="btn btn-block btn-primary">Submit</button>
										    </div>
									    </div>
									</div><hr/>
									<div class="row">
										<div class="col-md-6"> 
											<div class="rtms">1234 / 1222</div>
											<input type="text" class="form-control" placeholder="Red Score"/><br/>
											<input type="text" class="form-control" placeholder="Red Penalty"/>
										</div>
										<div class="col-md-6">
											<div class="btms">6226 / 5015</div>
											<input type="text" class="form-control" placeholder="Blue Score"/><br/>
											<input type="text" class="form-control" placeholder="Blue Penalty"/>
										</div>
									</div>
									<div class="help-block">
										Penalties should be entered on the side that is gaining the points.
									</div>
							    </div>
							</div>
						</div>
		  			</div>
  				</div>
  			</div>
  			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
		  				<div class="panel-heading">
		    				<h3 class="panel-title">
		    					Score Spread
		    				</h3>
		  				</div>
		  				<div class="panel-body">
		  					<p>Shows the amount of matches that have had scores within each range.</p>
		  					<svg id="spread" style="width: 100%;">
		  						<text font-size="11px" x="10" y="11">frequency</text>
		  						<g id="axis">
		  						</g>
		  					</svg>
		  				</div>
		  			</div>
		  		</div>
	  		</div>
			<div class="row">
				<div class="col-md-12">
		  			<div class="panel panel-default">
		  				<div class="panel-heading">
		  					<h3 class="panel-title">
		  						Match Odds Prediction
		  					</h3>
		  				</div>
		  				<div class="panel-body">
		  					<p>Enter 2 or 4 teams to calculate odds of victory.</p>
		  					<div class="row">
		  						<div class="col-md-5">
		  							<input type="text" class="form-control" id="pred1" placeholder="Red Team"> <br/>
		  							<input type="text" class="form-control" id="pred2" placeholder="Red Team"> <br/>
		  							<div style='text-align: center;font-size: 14pt;' id="podds">N/A</div>
		  						</div>
		  						<div class="col-md-2">
				  					<div style="text-align:center;font-size: 14pt;margin-top: 30px;">VS</div>
		  						</div>
								<div class="col-md-5">
		  							<input type="text" class="form-control" id="pblue1" placeholder="Blue Team"> <br/>
		  							<input type="text" class="form-control" id="pblue2" placeholder="Blue Team"> <br/>
		  							<div style='text-align: center;font-size: 14pt;' id="poddsb">N/A</div>

		  						</div>
		  					</div>
		  				</div>
		  			</div>
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

<script src="../jquery.js"></script>
<script type="text/javascript" src="../datatables.js"></script>
<script src="../d3.js" charset="utf-8"></script>
<script src="../bootstrap.js"></script>
<script src="../jquery.growl.js" type="text/javascript"></script>
<script src="../common.js"></script>


<script>

// cool constants bro (hyperparameters)
			var n = 1;
			var k = 20;
			var e = 2.71828;



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


		var teams = {};
		var teamstbl, rowstbl;
		function setrows(rows, ttms)
		{
			var tbl = "";
			var tlb = "";
			teams = {};

			for(var a=0;a<rows.length;a++)
			{
				// lets do some stuff here.

				
				
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
					amts[Math.floor(teams[key].scores[i]/spr)] += 0.5;
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
				cnt ++;
				console.log(key + ": "+teams[key].score+ ", "+teams[key].avg);
				teams[key].nummatch = teams[key].alliance.length;
			}
			console.log(favg);
			console.log(cnt);
			favg /= cnt;



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
				var abc = ""
				for(var a=0;a<teams[key].alliance.length;a++)
				{
					var er = teams[teams[key].alliance[a]].dv/(Math.sqrt(teams[key].nummatch)*teams[teams[key].alliance[a]].avg);
					teams[key].errors.push(er);
					err += 1/er;
				}
				teams[key].weight = 1/err;
				//teams[key].error = teams[key].dv/(Math.sqrt(teams[key].nummatch));
			}
			var k = favg/1;
			console.log(favg);
			for(key in teams)
			{
				teams[key].adj = [];
				var counter = 0;
				for(var i=0; i < teams[key].alliance.length; i++)
				{
					var sco = teams[key].scores[i]*sigmoid((teams[key].avg-teams[teams[key].alliance[i]].avg)/k);
					counter += sco;
					teams[key].adj.push(sco);
				}
				teams[key].rel = Math.round(counter/teams[key].scores.length);

				var aavg = 0;

				var sd = 0;
				for(var i=0;i<teams[key].alliance.length;i++)
				{
					sd += Math.pow((teams[key].adj[i]-teams[key].rel), 2);
				}
				teams[key].sd = Math.sqrt(sd/teams[key].scores.length-1);
				teams[key].error = Math.sqrt(sd/(teams[key].scores.length-1))/(Math.sqrt(teams[key].alliance.length)*teams[key].rel);
				teams[key].wins = 0;
				teams[key].plays = 0;
			}


			// lets do some sampling.......
			var smp = [];
			for(key in teams)
	 		{
				smp.push({"team":key,"mean":teams[key].rel,"std":teams[key].sd,"wins":0});
			}

			tbl = "";
			if(ttms != undefined)
			{
				for(a in ttms)
				{
					var issco = rows[a] != undefined;

					var clc = calcOdds(ttms[a], teams, 10000).toFixed(0);
					if(clc == 0) clc = 1;
					else if(clc == 100) clc = 99;
					

					tbl += "<tr>";
					if(issco)
					{
						tbl += "<td>"+xss(rows[a].match)+"</td>";
						if(Number(rows[a].redscore) > Number(rows[a].bluescore))
						{
							tbl += "<td class='redwin'>"+xss(rows[a].red1)+"</td>";
							tbl += "<td class='redwin'>"+xss(rows[a].red2)+"</td>";
							if(rows[a].redpenalty != undefined && rows[a].redpenalty != 0)
							{
								tbl += "<td class='redwin' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss("("+rows[a].redpenalty+") "+rows[a].redscore)+"</td>";
							}
							else
								tbl += "<td class='redwin' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss(rows[a].redscore)+"</td>";

							tbl += "<td class='info'>"+xss(rows[a].blue1)+"</td>";
							tbl += "<td class='info'>"+xss(rows[a].blue2)+"</td>";
							if(rows[a].bluepenalty != undefined && rows[a].bluepenalty != 0)
							{
								tbl += "<td class='info' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss("("+rows[a].bluepenalty+") "+rows[a].bluescore)+"</td>";
							}
							else
								tbl += "<td class='info' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss(rows[a].bluescore)+"</td>";

						}
						else if(Number(rows[a].redscore) < Number(rows[a].bluescore))
						{
							tbl += "<td class='danger'>"+xss(rows[a].red1)+"</td>";
							tbl += "<td class='danger'>"+xss(rows[a].red2)+"</td>";
							if(rows[a].redpenalty != undefined && rows[a].redpenalty != 0)
							{
								tbl += "<td class='danger' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss("("+rows[a].redpenalty+") "+rows[a].redscore)+"</td>";
							}
							else
								tbl += "<td class='danger' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss(rows[a].redscore)+"</td>";

							tbl += "<td class='bluewin'>"+xss(rows[a].blue1)+"</td>";
							tbl += "<td class='bluewin'>"+xss(rows[a].blue2)+"</td>";
							if(rows[a].bluepenalty != undefined && rows[a].bluepenalty != 0)
							{
								tbl += "<td class='bluewin' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss("("+rows[a].bluepenalty+") "+rows[a].bluescore)+"</td>";
							}
							else
								tbl += "<td class='bluewin' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss(rows[a].bluescore)+"</td>";
						}
						else
						{
							tbl += "<td class='redwin'>"+xss(rows[a].red1)+"</td>";
							tbl += "<td class='redwin'>"+xss(rows[a].red2)+"</td>";
							if(rows[a].redpenalty != undefined && rows[a].redpenalty != 0)
							{
								tbl += "<td class='redwin' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss("("+rows[a].redpenalty+") "+rows[a].redscore)+"</td>";
							}
							else
								tbl += "<td class='redwin' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss(rows[a].redscore)+"</td>";

							tbl += "<td class='bluewin'>"+xss(rows[a].blue1)+"</td>";
							tbl += "<td class='bluewin'>"+xss(rows[a].blue2)+"</td>";
							if(rows[a].bluepenalty != undefined && rows[a].bluepenalty != 0)
							{
								tbl += "<td class='bluewin' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss("("+rows[a].bluepenalty+") "+rows[a].bluescore)+"</td>";
							}
							else
								tbl += "<td class='bluewin' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss(rows[a].bluescore)+"</td>";
						}
						
						tbl += "<td class='' data-order='"+(clc)+"'><em><span style='color:#ff6666;'>"+clc+"%</span> / <span style='color:#6666ff;'>"+(100-clc).toFixed(0)+"%</span></em></td>";
					}
					else
					{
						tbl += "<td class='danger'>"+xss(ttms[a].red1)+"</td>";
						tbl += "<td class='danger'>"+xss(ttms[a].red2)+"</td>";
						
						tbl += "<td class='danger' style='text-align: right;' data-order='0'>-</td>";

						tbl += "<td class='info'>"+xss(ttms[a].blue1)+"</td>";
						tbl += "<td class='info'>"+xss(ttms[a].blue2)+"</td>";

						tbl += "<td class='info' style='text-align: right;' data-order='0'>-</td>";


					}

					tbl += "</tr>";
				}
			}
			else
			{
				for(var a = 0;a<rows.length;a++)
				{

					var clc = calcOdds(rows[a], teams, 10000).toFixed(0);
					if(clc == 0) clc = 1;
					else if(clc == 100) clc = 99;
					

					tbl += "<tr>";

					tbl += "<td>"+xss(rows[a].match)+"</td>";
					if(Number(rows[a].redscore) > Number(rows[a].bluescore))
					{
						tbl += "<td class='redwin'>"+xss(rows[a].red1)+"</td>";
						tbl += "<td class='redwin'>"+xss(rows[a].red2)+"</td>";
						if(rows[a].redpenalty != undefined && rows[a].redpenalty != 0)
						{
							tbl += "<td class='redwin' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss("("+rows[a].redpenalty+") "+rows[a].redscore)+"</td>";
						}
						else
							tbl += "<td class='redwin' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss(rows[a].redscore)+"</td>";

						tbl += "<td class='info'>"+xss(rows[a].blue1)+"</td>";
						tbl += "<td class='info'>"+xss(rows[a].blue2)+"</td>";
						if(rows[a].bluepenalty != undefined && rows[a].bluepenalty != 0)
						{
							tbl += "<td class='info' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss("("+rows[a].bluepenalty+") "+rows[a].bluescore)+"</td>";
						}
						else
							tbl += "<td class='info' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss(rows[a].bluescore)+"</td>";

					}
					else if(Number(rows[a].redscore) < Number(rows[a].bluescore))
					{
						tbl += "<td class='danger'>"+xss(rows[a].red1)+"</td>";
						tbl += "<td class='danger'>"+xss(rows[a].red2)+"</td>";
						if(rows[a].redpenalty != undefined && rows[a].redpenalty != 0)
						{
							tbl += "<td class='danger' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss("("+rows[a].redpenalty+") "+rows[a].redscore)+"</td>";
						}
						else
							tbl += "<td class='danger' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss(rows[a].redscore)+"</td>";

						tbl += "<td class='bluewin'>"+xss(rows[a].blue1)+"</td>";
						tbl += "<td class='bluewin'>"+xss(rows[a].blue2)+"</td>";
						if(rows[a].bluepenalty != undefined && rows[a].bluepenalty != 0)
						{
							tbl += "<td class='bluewin' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss("("+rows[a].bluepenalty+") "+rows[a].bluescore)+"</td>";
						}
						else
							tbl += "<td class='bluewin' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss(rows[a].bluescore)+"</td>";
					}
					else
					{
						tbl += "<td class='redwin'>"+xss(rows[a].red1)+"</td>";
						tbl += "<td class='redwin'>"+xss(rows[a].red2)+"</td>";
						if(rows[a].redpenalty != undefined && rows[a].redpenalty != 0)
						{
							tbl += "<td class='redwin' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss("("+rows[a].redpenalty+") "+rows[a].redscore)+"</td>";
						}
						else
							tbl += "<td class='redwin' style='text-align: right;' data-order='"+rows[a].redscore+"'>"+xss(rows[a].redscore)+"</td>";

						tbl += "<td class='bluewin'>"+xss(rows[a].blue1)+"</td>";
						tbl += "<td class='bluewin'>"+xss(rows[a].blue2)+"</td>";
						if(rows[a].bluepenalty != undefined && rows[a].bluepenalty != 0)
						{
							tbl += "<td class='bluewin' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss("("+rows[a].bluepenalty+") "+rows[a].bluescore)+"</td>";
						}
						else
							tbl += "<td class='bluewin' style='text-align: right;' data-order='"+rows[a].bluescore+"'>"+xss(rows[a].bluescore)+"</td>";
					}
					
					tbl += "<td class='' data-order='"+(clc)+"'><em><span style='color:#ff6666;'>"+clc+"%</span> / <span style='color:#6666ff;'>"+(100-clc).toFixed(0)+"%</span></em></td>";
					tbl += "</tr>";
				}
			}


			if(smp.length >= 4)
			{
				for(var i=0;i<100000;i++)
				{
					var tms = [];
					for(var j=0;j<4;j++)
					{
						var rng = Math.floor(Math.random()*smp.length);
						var good = true;
						for(var k=0;k<tms.length;k++)
						{
							if(tms[k].team == smp[rng].team)
							{
								good = false;
							}
						}
						if(!good)
						{
							j--;
							continue;
						}
						tms.push(smp[rng]);
					}

					//Φ((μX – μY)/√(σX2 + σY2))
					// have four teams...
					var t1 = (tms[0].mean+(grand()*tms[0].std))+(tms[1].mean+(grand()*tms[1].std));
					var t2 = (tms[2].mean+(grand()*tms[2].std))+(tms[3].mean+(grand()*tms[3].std));

					for(var j=0;j<4;j++)
					{
						teams[tms[j].team].plays++;
					}

					if(t1 > t2)
					{
						teams[tms[0].team].wins++;
						teams[tms[1].team].wins++;
					}
					else
					{
						teams[tms[2].team].wins++;
						teams[tms[3].team].wins++;
					}
				}

				for(key in teams)
				{
					teams[key].wr = teams[key].wins/teams[key].plays;
				}
			}

			// for testing purposes...
			/*for(var a=0;a<1000;a++)
			{
				var cm = 0;
				for(var b=0;b<100;b++)
				{
					for(key in teams)
					{
						teams[key].plays = 0;
						teams[key].wins = 0;
					}
					for(var i=0;i<a;i++)
					{
						var tms = [];
						for(var j=0;j<4;j++)
						{
							var rng = Math.floor(Math.random()*smp.length);
							var good = true;
							for(var k=0;k<tms.length;k++)
							{
								if(tms[k].team == smp[rng].team)
								{
									good = false;
								}
							}
							if(!good)
							{
								j--;
								continue;
							}
							tms.push(smp[rng]);
						}

						//Φ((μX – μY)/√(σX2 + σY2))
						// have four teams...
						var t1 = (tms[0].mean+(grand()*tms[0].std))+(tms[1].mean+(grand()*tms[1].std));
						var t2 = (tms[2].mean+(grand()*tms[2].std))+(tms[3].mean+(grand()*tms[3].std));

						for(var j=0;j<4;j++)
						{
							teams[tms[j].team].plays++;
						}

						if(t1 > t2)
						{
							teams[tms[0].team].wins++;
							teams[tms[1].team].wins++;
						}
						else
						{
							teams[tms[2].team].wins++;
							teams[tms[3].team].wins++;
						}
					}
					var dv = 0;
					var cnt = 0;
					for(key in teams)
					{	
						if(teams[key].plays == 0) wr = 0.5;
						else var wr = teams[key].wins/teams[key].plays;
						dv += Math.pow(Number(wr)-Number(teams[key].wr), 2);
						cnt++;
					}
					dv = Math.sqrt(dv/cnt);
					cm += dv;
				}
				cm /= 1000;
				console.log(cm);
			}*/

			var ntms = rsort(teams);
	
			for(var i=0;i<ntms.length;i++)
			{
				if(ntms[i].key.indexOf("*") != -1) continue;

				tlb += "<tr>";
				tlb += "<td>"+(i+1)+"</td>";
				tlb += "<td> <a href='../team?"+xss(ntms[i].key)+"'>"+xss(ntms[i].key)+"</a></td>";
				tlb += "<td style='text-align: right;'>"+ntms[i].scores.length+"</td>";
				tlb += "<td style='text-align: right;'>"+ntms[i].qp+"</td>";
				tlb += "<td style='text-align: right;'>"+ntms[i].rp+"</td>";
				if(ntms[i].scores.length == 1)
					tlb += "<td style='text-align: right;' data-order='0'><em>0*</em></td>";
				else
					tlb += "<td style='text-align: right;' data-order='"+ntms[i].rel+"' title='"+ntms[i].rel+" ("+(ntms[i].error*100).toFixed(0)+"%)'><em>"+ntms[i].rel+"</em></td>";
				var pqp = ((ntms[i].wins/ntms[i].plays)*(ntms[i].alliance.length*2)).toFixed(2)
				tlb+= "<td style='text-align: right;'><em>"+pqp+"</em></td>";
				var def = (pqp-ntms[i].qp).toFixed(2);
				if(def >= 0)
				{
					tlb += "<td style='color: #33CC33;text-align: right;'><em>+"+def+"</em></td>";
				}
				else
				{
					tlb += "<td style='color: #FF3333;text-align: right;'><em>"+def+"</em></td>";
				}				

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
					"order": [[ 3, 'desc' ], [ 4, 'desc' ]]
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
                
                var teamsdata
				if(data.rows != undefined)
				{
					rowsdata = data.rows;
					teamsdata = undefined;
				} 
				else
				{
					rowsdata = data.scores;
					teamsdata = data.teams;
				}

                setrows(rowsdata, teamsdata);
                
				unconfs();

				$("h1").text(data.name);
				$("title").text("Competition - "+data.name+" - FTCList");
				//setrows(data.rows);
		
			});


			$("#msub").click(function() {
				var obj = {};
				obj.type = "match";
				obj.match = $("#mnum").val();
				obj.red1 = $("#mrt1").val();
				obj.red2 = $("#mrt2").val();
				obj.comp = comp();

				obj.blue1 = $("#mbt1").val();
				obj.blue2 = $("#mbt2").val();

				$.post("../newadd.php", obj, function(result) {
					if(JSON.parse(result).title != "Error")
					{
						$("#mnum").val(Number($("#mnum").val())+1);
						$("#mrt1").val("");
						$("#mrt2").val("");
						$("#mbt1").val("");
						$("#mbt2").val("");
					}
					Growl.growl(JSON.parse(result));
				});
			})




			$("#pred1, #pred2, #pblue1, #pblue2").on("input propertychange", function() {
        	if(teams[$("#pred1").val().toString()] != undefined && teams[$("#pred1").val().toString()] != undefined && teams[$("#pblue1").val().toString()] != undefined && teams[$("#pblue2").val().toString()] != undefined)
        	{
        		var rw = {};
        		rw.red1 = $("#pred1").val();
        		rw.red2 = $("#pred2").val();
        		rw.blue1 = $("#pblue1").val();
        		rw.blue2 = $("#pblue2").val();
        		var odds = calcOdds(rw, teams, 1000000);
        		$("#podds").text(odds+"%");
        		$("#poddsb").text((100-odds).toFixed(1)+"%");
        	}
        	else if(teams[$("#pred1").val()] != undefined && teams[$("#pblue1").val()] != undefined && $("#pred2").val() == "" && $("#pblue2").val() == "")
        	{
        		var rw = {}
        		rw.red1 = $("#pred1").val();
        		rw.red2 = "NA";
        		rw.blue1 = $("#pblue1").val();
        		rw.blue2 = "NA";
        		var odds = calcOdds(rw, teams, 1000000);
        		$("#podds").text(odds+"%");
        		$("#poddsb").text((100-odds).toFixed(1)+"%");

        	}
        	else
        	{
        		$("#podds").text("N/A");
        		$("#poddsb").text("N/A");
        	}

        })

			$(".tabblocker1").on("focus", function() {
				$("input[tabindex=1]").focus();
			})

		});
        var rowsdata = [];
		var confs = [];

		function calcOdds(data, smp, amt)
		{
			var wins = 0;
			for(var a=0;a<amt;a++)
			{
				if(data.red2 == "NA")
				{
					var t1 = smp[data.red1].rel+(grand()*smp[data.red1].sd);
					var t2 = smp[data.blue1].rel+(grand()*smp[data.blue1].sd);
				}
				else
				{
					var t1 = (smp[data.red1].rel+(grand()*smp[data.red1].sd))+(smp[data.red2].rel+(grand()*smp[data.red2].sd));
					var t2 = (smp[data.blue1].rel+(grand()*smp[data.blue1].sd))+(smp[data.blue2].rel+(grand()*smp[data.blue2].sd));
				}

				if(t1 > t2)
				{
					wins++;
				}
			}
			return Math.round(wins/(amt/1000))/10;
		}


		function grand()
		{
			do {
				var u = Math.random() * 2 - 1;
				var v = Math.random() * 2 - 1;
				var r = u*u+v*v;
			} while (r >= 1);
			return  u * Math.sqrt(-2 * Math.log(r) / r);
		}

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

		function sigstep(key, teams, depth)
		{
			if(depth == 0)
			{
				return teams[key].avg/2;
			}

			var counter = 0;
			for(var i=0; i < teams[key].alliance.length; i++)
			{
				counter += teams[key].scores[i]*sigmoid((sigstep(key, teams, depth-1)-sigstep(teams[key].alliance[i], teams, depth-1))/k);
			}
			return counter/teams[key].alliance.length;
		}

		function sigmoid(v)
		{
			return 1/(1+Math.pow(e, -v));
		}

		function rsort(teams)
		{
			var output = [];

			for(key in teams)
			{
				teams[key].key = key;
				output.push(teams[key]);
			}
			var sieve = {};

			for(var i=0;i<4;i++)
			{
				for(var j=0;j<output.length;j++)
				{
					var group = (Math.floor(output[j].rp/Math.pow(10, i))%10).toString();
					if(sieve[group] == undefined) sieve[group] = [];
					sieve[group].push(output[j]);
				}
				output = join(sieve);
				sieve = {};
			}

			for(var i=0;i<2;i++)
			{
				for(var j=0;j<output.length;j++)
				{
					var group = (Math.floor(output[j].qp/Math.pow(10, i))%10).toString();
					if(sieve[group] == undefined) sieve[group] = [];
					sieve[group].push(output[j]);
				}
				output = join(sieve);
				sieve = {};
			}
			return output.reverse();
		}

		function join(sieve)
		{
			var output = [];
			for(var i=0;i<10;i++)
			{
				if(sieve[i.toString()] != undefined)
					output = output.concat(sieve[i.toString()]);
			}
			return output;
		}


		function unconfs() {
			$("#unconfs").text("No Unconfirmed Matches");
			$.getJSON("../data/unconf/"+comp()+".json",function(data) {
				if(data.rows == undefined)
				{
					$("#unconfs").text("No Unconfirmed Matches");
					return;
				}
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