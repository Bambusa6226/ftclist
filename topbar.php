
<nav class="navbar navbar-default navbar-fixed-top">
  	<div class="container">
  		<div class="navbar-header">
      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        		<span class="sr-only">Toggle navigation</span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
      		</button>
      		<a class="navbar-brand" href="#">FTCList</a>
    	</div>
      	<ul class="nav navbar-nav navbar-right">
    		<li><a href="#" id="navteam">Team</a></li>
    		<li><a href="#" id="navregion">Region</a></li>

    		<li><a <?php if(!isset($ISHOME)) echo 'href="../logout.php"'; else echo 'href="./logout.php"'; ?> id="navlogout">Log Out</a></li>
      			
            <li><a href="#" id="navlogin" style="display: none;">Login</a></li>
            <li><a href="#" id="navregister" style="display: none;">Register</a></li>
        </ul>
      	<form class="navbar-form navbar-right" role="search" style="margin-right: 10px;">
  			<div class="form-group">
    			<input type="text" class="form-control" placeholder="Search">
  			</div>
		</form>	
	</div>
</nav>
