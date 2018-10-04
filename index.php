<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
<title>Fantasy Spelling</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <style>
  .modal {
  	    width: 80%;
  }
.modal {
    max-width: 300px;
    max-height: 420px;
    overflow: visible;
}
h1{font-size:2.6rem;line-height:normal;margin-top:0;font-weight:300;}h2{font-size:1.4rem;font-weight:300;line-height:normal;margin-top:1rem;margin-bottom:.5rem}h3{font-size:1.4rem;font-weight:300;line-height:normal;margin:1rem 0 .5rem}h4{font-size:1.1rem;font-weight:500;line-height:normal;margin-bottom:.4rem}h5{font-size:1rem;font-weight:500;line-height:normal}h6{font-size:1rem;font-weight:500;line-height:normal}

.modal h3 {
margin-top: 0;
font-weight:500;
    margin-bottom: 1rem
}


.start-splash-header-content {
padding-top: 60px;	}
@media only screen and (max-width: 993px) {
	.start-splash-header-content {
		text-align:center;
		padding-top: 30px;
	}
}
  </style>

</head>

<body>
<?php
        if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        	if (!empty($_SESSION["leaguenames"]) || !empty($_SESSION["leaguenames10"])) {
        		echo "<ul id=\"dropdown1\" class=\"dropdown-content\">";
        		for ($i = 0; $i < count($_SESSION['leaguenames']); $i++) {
    				echo "<li> <a href=\"";
    				if ($_SESSION["leaguedrafts"][$i]) {
    					echo "scores.php?lid=";
    					echo ($_SESSION["leagueids"][$i]);
    				} else {
    					echo "drafting.php?lid=";
    					echo ($_SESSION["leagueids"][$i]);
    				}
    				echo "\">";
    				echo htmlspecialchars($_SESSION["leaguenames"][$i]);
    				echo "</a></li>";
				}
				for ($i = 0; $i < count($_SESSION['leaguenames10']); $i++) {
    				echo "<li> <a href=\"";
    				if ($_SESSION["leaguedrafts10"][$i]) {
    					echo "scores10.php?lid=";
    					echo ($_SESSION["leagueids10"][$i]);
    				} else {
    					echo "drafting10.php?lid=";
    					echo ($_SESSION["leagueids10"][$i]);
    				}
    				echo "\">";
    				echo htmlspecialchars($_SESSION["leaguenames10"][$i]);
    				echo "</a></li>";
				}
				echo "</ul>";
        	}
        }

?>
 <nav class="grey darken-3" role="navigation">
    <div class="nav-wrapper container">
    <a id="logo-container" href="#" class="brand-logo"><span style="font-family:Calibri;">Fantasy Spelling
  			</span></a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="index.php">Home</a></li>
        <?php
        if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        	echo "<li><a href='logout.php'>Log Out</a></li>
        	<li><a href='newuser.php'>New League</a></li>";
        	if (!empty($_SESSION["leaguenames"]) || !empty($_SESSION["leaguenames10"])) {
        		$stringm="<li><a class=\"dropdown-button\" href=\"#!\" data-activates=\"dropdown1\">Leagues<i class=\"material-icons right\">arrow_drop_down</i></a></li>";
        		echo $stringm;
        	}
        } else {
        echo"<li><a href='#modal'>Log In</a></li>
        <li><a href='signup.php'>Sign Up</a></li>";
    	}
        ?>
      </ul>

      <ul id="mobile-demo" class="side-nav">
        <li><a href="index.php">Home</a></li>
        <?php
        if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        	echo "<li><a href='logout.php'>Logout</a></li>
        	<li><a href='newuser.php'>New League</a></li>";
        	for ($i = 0; $i < count($_SESSION['leaguenames']); $i++) {
            echo "<li> <a href=\"";
            if ($_SESSION["leaguedrafts"][$i]) {
              echo "scores.php?lid=";
              echo ($_SESSION["leagueids"][$i]);
            } else {
              echo "drafting.php?lid=";
              echo ($_SESSION["leagueids"][$i]);
            }
            echo "\">";
            echo htmlspecialchars($_SESSION["leaguenames"][$i]);
            echo "</a></li>";
        }
        for ($i = 0; $i < count($_SESSION['leaguenames10']); $i++) {
            echo "<li> <a href=\"";
            if ($_SESSION["leaguedrafts10"][$i]) {
              echo "scores10.php?lid=";
              echo ($_SESSION["leagueids10"][$i]);
            } else {
              echo "drafting10.php?lid=";
              echo ($_SESSION["leagueids10"][$i]);
            }
            echo "\">";
            echo htmlspecialchars($_SESSION["leaguenames10"][$i]);
            echo "</a></li>";
        }
        } else {
        echo"<li><a href='#modal'>Log In</a></li>
        <li><a href='signup.php'>Sign Up</a></li>";
          
    	}
        ?>
      </ul>
    </div>
  </nav>
  <div class="section no-pad-bot grey darken-4" id="index-banner">
  	<div class="container">	
  <br/>
  <br/>
  	<div class="row">
  		<div class ="col s12 l6 white-text text-white">
  		<div class="start-splash-header-content">
  		<h1>
  			Feel like a winner
  		</h1>
  		
  		<h2>
  		... without doing any of the spelling
  		</h2>
  		</div>
  		<br/>
  		<br/>
  		</div>
  		<div class = "col s12 l6 white-text text-white">
  		<img class="responsive-img" src="money.jpg" />
  		</div>
  	</div>
  	<br/>
  <br/>
  	</div>
  </div>

  <br/>
  <br/>
  <h1 class="center-align">About</h3>
  <div class="row container">
<div class="col s12">
<h3 class="light">Liven up watching the national spelling bee by making your own perfect spelling team. Create your own team of fantasy spellers to win it all. </h3>
<h3 class="light">Create or join a league of 5 or 10 people, and then start a draft. Your team must have 6 spellers along with 4 spellers on the bench that can be swwapped in between spelling rounds.</h3>
<h3 class="light">The spelling bee will take palce May 31 and June 1. During that time scores will be automatically updated. You will earn a point for every word that your spellers can spell correctly. Trades are aso possible. Between rounds players will be able to trade their spellers with other spellers within their own league.</h3>
<h3 class="light">Find more information about the spellers <a href="http://spellingbee.com/meet-the-spellers/2017">here</a>.</h3>
<h3 class="light">Learn the rules of spelling bee  <a href="http://spellingbee.com/sites/default/files/inline-files/Contest%20Rules%20of%20the%202017%20Scripps%20National%20Spelling%20Bee.pdf">here</a>.</h3>
</div>
  <section>


  <!-- Modal Structure -->
  <div id="modal" class="modal">
  <form action="dblogin.php" method="post">
    <div class="modal-content">
    <div class="row">
    <div class="col s12">
      <h3>Login</h3>
      </div> 
      <div class="col s12">
      <p><?php
      if ($_SERVER["REQUEST_METHOD"] === "GET") {
  				if (isset($_GET['uop']) && !empty($_GET["uop"])) {
  					echo "Username or Password was incorrect";
				}
			}
  	?></p>
  	</div>
     <div class="input-field col s12">
     <i class="material-icons prefix">account_circle</i>
     <input id="username" name="username" type="text">
     <label for="username">Username</label>
     </div>
     <div class="input-field col s12">
     <i class="material-icons prefix">lock_outline</i>
     <input id="password" type="password" name="password">
     <label for="password">Password</label>
     </div>
     <div class="col s12">
     <p>Don't have an account? Click <a href="signup.php">here</a>.</p>
     </div>
    </div>

    <div class="modal-footer">
    <button type="submit" class="waves-effect btn-flat main-blue" style="float: right; margin: 6px 0;color: #04afef;">LOGIN</button>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">CLOSE</a>
    </div>
    </div>
    </form>
  </div>
  </section>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>
$(document).ready(function(){
     $(".button-collapse").sideNav( {draggable: true,closeOnClick: true});
     $('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: 0.8, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Ending top style attribute
      ready: function(modal, trigger) {},
      complete: function() { } // Callback for Modal close
    });
});
</script>
<script> <?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  				if (isset($_GET['uop']) && !empty($_GET["uop"])) {
  				$str = "setTimeout(function(){
  					$('#modal').modal('open');}
  					, 100);";
            echo $str;
				}
			}
?>
</script>
</body>
</html>
