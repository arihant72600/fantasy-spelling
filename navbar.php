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
        	echo "<li><a href='logout.php'>Log Out</a></li>
        	<li><a href='newuser.php'>New League</a></li>";
        	if (!empty($_SESSION["leaguenames"]) || !empty($_SESSION["leaguenames10"])) {
        		$stringm="<li><a class=\"dropdown-button\" href=\"#!\" data-activates=\"dropdown1\">Leagues<i class=\"material-icons right\">arrow_drop_down</i></a></li>";
        		echo $stringm;
        	}
        ?>
      </ul>

      <ul id="mobile-demo" class="side-nav">
        <li><a href="index.php">Home</a></li>
        <?php
        	echo "<li><a href='logout.php'>Logout</a></li>
        	<li><a href='newuser.php'>New League</a></li>";
           if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
          if (!empty($_SESSION["leaguenames"])) {
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
       }
     }
        ?>
      </ul>
    </div>
  </nav>