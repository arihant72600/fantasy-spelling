<?php
session_start();
if (!(isset($_SESSION['id']) && !empty($_SESSION['id']))) {
	header("Location: index.php");
	exit();
}
if ($_SERVER["REQUEST_METHOD"] === "GET"){
	if (isset($_GET['lid']) && !empty($_GET["lid"])) {
  		if (null === ($lid = filter_input(INPUT_GET, 'lid', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE))) {
  			header("Location: index.php?7");
			exit();
		} 
	} else {
		header("Location: index.php?8");
		exit();
	}
  $configs = include('config.php');

  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

	if ($conn->connect_error) {
		die("Connection failed: ");
	} 
	$stmt = $conn->prepare("SELECT league_name, creatorid, user_id_2, user_id_3, user_id_4, user_id_5, user_id_6, user_id_7, user_id_8, user_id_9, user_id_10, has_drafted FROM leagues10 WHERE league_id=?");
	$stmt->bind_param("i", $lid);
	$stmt->execute();
	$stmt->bind_result($leaguename,$c,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10,$has_drafted);
	
	if (!($stmt->fetch())) {
		$stmt->close();
		$conn->close();
		header("Location: newuser.php?error=noleague");
		exit();
	}
	$stmt->close();
	$conn->close();
	if ($has_drafted) {
		$stmt->close();
		$stmt->close();
		$k=array_search ($leaguename,$_SESSION["leaguenames"]);
		$_SESSION["leaguedrafts"][$k]=True;
		header("Location: scores.php?lid=$lid");
		exit();
	}
	if (empty($u10)) {
		header("Location: index.php");
	}
	if (!(in_array($_SESSION["id"],array($c,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10),True))) {
		header("Location: index.php?17");
		exit();
	}
	$ct=($c===$_SESSION["id"]);
} else {
	header("Location: index.php");
	exit();
}


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




  </style>
<link href="css/select2.min.css" rel="stylesheet" />
<link href="css/select2-materialize.css" rel="stylesheet" />
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
<?php
if ($ct) {
	include "draftc10.php";
} elseif(!$ct) {
	include "draftnc10.php";
}
?>
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script src="js/select2.min.js"></script>
<script>
$(document).ready(function(){
     $(".button-collapse").sideNav( {draggable: true,closeOnClick: true});
     $(".js-example-basic-multiple").select2();
});
</script>
</body>
</html>