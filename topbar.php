
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

    		<li><a id="navlogout">Log Out</a></li>
      			
            <li><a href="#" id="navlogin" style="display: none;" data-toggle="modal" data-target="#modal_login">Login</a></li>
            <li><a href="../register" id="navregister" style="display: none;">Register</a></li>
        </ul>
      	<form id="navsearch" class="navbar-form navbar-right" role="search" style="margin-right: 10px;" action="../search" method="GET">
  			<div class="form-group">
    			<input name="s" type="text" class="form-control" placeholder="Search">
  			</div>
		</form>	
	</div>
</nav>


  <div class="modal fade" id="modal_login">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Login to FTCList</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="login.php" id="loginform">
                    <input class="form-control" type="text" name="team" placeholder="Team Number"><br/>
                    <input class="form-control" type="password" name="pass" placeholder="Password">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary">Login</button>
          </form>
            </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->