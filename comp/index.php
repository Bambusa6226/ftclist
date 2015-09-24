<?php
// and here we need

// a list of all the matches and their scores
// add a match result?
// current and final team standings

?>

<html>
<head>
	<title>Comp - COMPNAME</title>
	<script src="../../jquery.js"></script>
	<script>
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
				tbl += "<td>"+rows[a].red1+"</td>";
				tbl += "<td>"+rows[a].red2+"</td>";
				tbl += "<td>"+rows[a].redscore+"</td>";
				tbl += "<td>"+rows[a].blue1+"</td>";
				tbl += "<td>"+rows[a].blue2+"</td>";
				tbl += "<td>"+rows[a].bluescore+"</td>";
				tbl += "</tr>";

				if(teams[rows[a].red1] == undefined)
				{
					teams[rows[a].red1] = {};
					teams[rows[a].red1].score = 0;
					teams[rows[a].red1].qp = 0;
					teams[rows[a].red1].rp = 0;
				}
				teams[rows[a].red1].score += Number(rows[a].redscore);
				teams[rows[a].red1].rp += Number(rows[a].bluescore);

				if(teams[rows[a].red2] == undefined)
				{
					teams[rows[a].red2] = {};
					teams[rows[a].red2].score = 0;
					teams[rows[a].red2].qp = 0;
					teams[rows[a].red2].rp = 0;
				}
				teams[rows[a].red2].score += Number(rows[a].redscore);
				teams[rows[a].red2].rp += Number(rows[a].bluescore);

				if(teams[rows[a].blue1] == undefined)
				{
					teams[rows[a].blue1] = {};
					teams[rows[a].blue1].score = 0;
					teams[rows[a].blue1].qp = 0;
					teams[rows[a].blue1].rp = 0;
				}
				teams[rows[a].blue1].score += Number(rows[a].bluescore);
				teams[rows[a].blue1].rp += Number(rows[a].redscore);

				if(teams[rows[a].blue2] == undefined)
				{
					teams[rows[a].blue2] = {};
					teams[rows[a].blue2].score = 0;
					teams[rows[a].blue2].qp = 0;
					teams[rows[a].blue2].rp = 0;
				}
				teams[rows[a].blue2].score += Number(rows[a].bluescore);
				teams[rows[a].blue2].rp += Number(rows[a].redscore);

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

			for(var key in teams)
			{
				tlb += "<tr>";
				tlb += "<td>"+key+"</td>";
				tlb += "<td>"+teams[key].qp+"</td>";
				tlb += "<td>"+teams[key].rp+"</td>";
				tlb += "</tr>";
			}

			console.log(tbl);
			$("#rows tbody").empty().append(tbl);
			$("#teams tbody").empty().append(tlb);
		}

		$("document").ready(function() {
	
			$("#comp").attr("value", comp());
			$.getJSON("../data/comps/"+comp()+".json", function(data) {
				$("h1").text("Comp - "+data.name+" - "+data.date);
				setrows(data.rows);
			})
		})
	</script>
</head>
<body>
	<h1>Comp - </h1>
	<h2>Add Row</h2>
	<form method="POST" action="../addrow.php">
		<input type="text" name="match" placeholder="Match number"></br>
		<input type="text" name="blue1" placeholder="Blue Alliance Team">
		<input type="text" name="blue2" placeholder="Blue Alliance Team">
		<input type="text" name="bluescore" placeholder="Blue Alliance Score"><br/>
		<input type="text" name="red1" placeholder="Red Aliance Team">
		<input type="text" name="red2" placeholder="Red Alliance Team">
		<input type="text" name="redscore" placeholder="Red Alliance Score"><br/>
		<input type='hidden' name='comp' id="comp">
		<input type="submit">
	</form>
	<h2>Rows</h2>
	<table id="rows" border="1">
		<thead>
			<tr>
				<th>match</th>
				<th>red 1</th>
				<th>red 2</th>
				<th>red score</th>
				<th>blue 1</th>
				<th>blue 2</th>
				<th>blue score</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

	<h2>Teams</h2>
	<table id="teams" border="1">
		<thead>
			<tr>
				<th>team</th>
				<th>qp</th>
				<th>rp</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</body>
</html>