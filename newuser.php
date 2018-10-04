<?php
session_start();
if (!(isset($_SESSION['id']) && !empty($_SESSION['id']))) {
	header("Location: index.php");
	exit();
}

include "navbar.php";
?>


<div class="section no-pad-bot" id="index-banner">
 <div class="container">
 <br/>
 <br/>
 <h1 class="header center">Start Today</h1>
 <div class="row center">
        <h3 class="header col s12 light">Choose to start a league or join one.</h3>
 </div>
 <br/><br/>
<div class="divider"></div>
</div></div>
 <div class="container">
<br/><br/>
<div class="row">
 <div class="col s12 m6">
 <h3 class="center">Join a league.</h3>
 <p class="light">Choose this option if you know someone who has already created a league, and has space available. Enter the league name below and then click join.</p>
<br/><br/>

</div>
 <div class="col s12 m6">
 <h3 class="center">Create a league.</h3>
<p  class="light">Choose this option if you want to start your own league. Create a name for your league and then click create.</p>
 </div>
 </div>
 <h4 class="center">Choose to either enter a league of 5 players or 10 players.</h4>
 <br/>
<h3 class="center">New League with 5 players</h3>
 <form action="drafting.php" method="post">
<div class="input-field">
<input id="leaguejoin" type="text" class="validate" name="leaguejoin">
<label for="leaguejoin">5 Player League Name</label>
 </div>
 <div class="row">
 <div class="col s6 center-align">
 <button type="submit" class="waves-effect waves-light btn" name="join">Join</button>
 </div><div class="col s6 center-align">
 <button type="submit" class="waves-effect waves-light btn" name="create">Create</button>
 </div>
 </div>
</form>
<br/<>
<div class="divider"></div>
<br/>
<br/>
<h3 class="center">New League with 10 players</h3>
 <form action="drafting10.php" method="post">
<div class="input-field">
<input id="leaguejoin" type="text" class="validate" name="leaguejoin">
<label for="leaguejoin">10 Player League Name</label>
 </div>
 <br/>
 <div class="row">
 <div class="col s6 center-align">
 <button type="submit" class="waves-effect waves-light btn" name="join">Join</button>
 </div><div class="col s6 center-align">
 <button type="submit" class="waves-effect waves-light btn" name="create">Create</button>
 </div>
 </div>
</form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>
$(document).ready(function(){
     $(".button-collapse").sideNav( {draggable: true,closeOnClick: true});
});
</script>
</body>
</html>
