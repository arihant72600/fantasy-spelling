<?php 
session_start();
if (!(isset($_SESSION["id"]))) {
	header("Location: index.php");
}
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

$stmt="SELECT league_name, creatorid, user_id_2, user_id_3, user_id_4, user_id_5, user_id_6, user_id_7, user_id_8, user_id_9, user_id_10, has_drafted FROM leagues10 WHERE league_id=$lid";
$row=$conn->query($stmt)->fetch_assoc();

$c=$row["creatorid"];
$u2=$row["user_id_2"];
$u3=$row["user_id_3"];
$u4=$row["user_id_4"];
$u5=$row["user_id_5"];
$u6=$row["user_id_6"];
$u7=$row["user_id_7"];
$u8=$row["user_id_8"];
$u9=$row["user_id_9"];
$u10=$row["user_id_10"];
$leaguename=$row["league_name"];
$has_drafted=$row["has_drafted"];
if (!$has_drafted) {
	header("Location: index.php");
	exit();
}
$ccteam=array();
$u2cteam=array();
$u3cteam=array();
$u4cteam=array();
$u5cteam=array();
$u6cteam=array();
$u7cteam=array();
$u8cteam=array();
$u9cteam=array();
$u10cteam=array();


$cbench=array();
$u2bench=array();
$u3bench=array();
$u4bench=array();
$u5bench=array();
$u6bench=array();
$u7bench=array();
$u8bench=array();
$u9bench=array();
$u10bench=array();


$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$c";
$row=$conn->query($stmt)->fetch_assoc();
$cscore=$row["score"];
$ctid=$row["team_id"];
array_push($ccteam,$row["speller_id_1"]);
array_push($ccteam,$row["speller_id_2"]);
array_push($ccteam,$row["speller_id_3"]);
array_push($ccteam,$row["speller_id_4"]);
array_push($ccteam,$row["speller_id_5"]);
array_push($ccteam,$row["speller_id_6"]);
array_push($cbench,$row["speller_id_7"]);
array_push($cbench,$row["speller_id_8"]);
array_push($cbench,$row["speller_id_9"]);
array_push($cbench,$row["speller_id_10"]);
$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$u2";
$row=$conn->query($stmt)->fetch_assoc();
$u2score=$row["score"];
$u2tid=$row["team_id"];
array_push($u2cteam,$row["speller_id_1"]);
array_push($u2cteam,$row["speller_id_2"]);
array_push($u2cteam,$row["speller_id_3"]);
array_push($u2cteam,$row["speller_id_4"]);
array_push($u2cteam,$row["speller_id_5"]);
array_push($u2cteam,$row["speller_id_6"]);
array_push($u2bench,$row["speller_id_7"]);
array_push($u2bench,$row["speller_id_8"]);
array_push($u2bench,$row["speller_id_9"]);
array_push($u2bench,$row["speller_id_10"]);
$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$u3";
$row=$conn->query($stmt)->fetch_assoc();
$u3score=$row["score"];
$u3tid=$row["team_id"];
array_push($u3cteam,$row["speller_id_1"]);
array_push($u3cteam,$row["speller_id_2"]);
array_push($u3cteam,$row["speller_id_3"]);
array_push($u3cteam,$row["speller_id_4"]);
array_push($u3cteam,$row["speller_id_5"]);
array_push($u3cteam,$row["speller_id_6"]);
array_push($u3bench,$row["speller_id_7"]);
array_push($u3bench,$row["speller_id_8"]);
array_push($u3bench,$row["speller_id_9"]);
array_push($u3bench,$row["speller_id_10"]);

$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$u4";
$row=$conn->query($stmt)->fetch_assoc();
$u4score=$row["score"];
$u4tid=$row["team_id"];
array_push($u4cteam,$row["speller_id_1"]);
array_push($u4cteam,$row["speller_id_2"]);
array_push($u4cteam,$row["speller_id_3"]);
array_push($u4cteam,$row["speller_id_4"]);
array_push($u4cteam,$row["speller_id_5"]);
array_push($u4cteam,$row["speller_id_6"]);
array_push($u4bench,$row["speller_id_7"]);
array_push($u4bench,$row["speller_id_8"]);
array_push($u4bench,$row["speller_id_9"]);
array_push($u4bench,$row["speller_id_10"]);
$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$u5";
$row=$conn->query($stmt)->fetch_assoc();
$u5score=$row["score"];
$u5tid=$row["team_id"];
array_push($u5cteam,$row["speller_id_1"]);
array_push($u5cteam,$row["speller_id_2"]);
array_push($u5cteam,$row["speller_id_3"]);
array_push($u5cteam,$row["speller_id_4"]);
array_push($u5cteam,$row["speller_id_5"]);
array_push($u5cteam,$row["speller_id_6"]);
array_push($u5bench,$row["speller_id_7"]);
array_push($u5bench,$row["speller_id_8"]);
array_push($u5bench,$row["speller_id_9"]);
array_push($u5bench,$row["speller_id_10"]);
$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$u6";
$row=$conn->query($stmt)->fetch_assoc();
$u6score=$row["score"];
$u6tid=$row["team_id"];
array_push($u6cteam,$row["speller_id_1"]);
array_push($u6cteam,$row["speller_id_2"]);
array_push($u6cteam,$row["speller_id_3"]);
array_push($u6cteam,$row["speller_id_4"]);
array_push($u6cteam,$row["speller_id_5"]);
array_push($u6cteam,$row["speller_id_6"]);
array_push($u6bench,$row["speller_id_7"]);
array_push($u6bench,$row["speller_id_8"]);
array_push($u6bench,$row["speller_id_9"]);
array_push($u6bench,$row["speller_id_10"]);
$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$u7";
$row=$conn->query($stmt)->fetch_assoc();
$u7score=$row["score"];
$u7tid=$row["team_id"];
array_push($u7cteam,$row["speller_id_1"]);
array_push($u7cteam,$row["speller_id_2"]);
array_push($u7cteam,$row["speller_id_3"]);
array_push($u7cteam,$row["speller_id_4"]);
array_push($u7cteam,$row["speller_id_5"]);
array_push($u7cteam,$row["speller_id_6"]);
array_push($u7bench,$row["speller_id_7"]);
array_push($u7bench,$row["speller_id_8"]);
array_push($u7bench,$row["speller_id_9"]);
array_push($u7bench,$row["speller_id_10"]);
$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$u8";
$row=$conn->query($stmt)->fetch_assoc();
$u8score=$row["score"];
$u8tid=$row["team_id"];
array_push($u8cteam,$row["speller_id_1"]);
array_push($u8cteam,$row["speller_id_2"]);
array_push($u8cteam,$row["speller_id_3"]);
array_push($u8cteam,$row["speller_id_4"]);
array_push($u8cteam,$row["speller_id_5"]);
array_push($u8cteam,$row["speller_id_6"]);
array_push($u8bench,$row["speller_id_7"]);
array_push($u8bench,$row["speller_id_8"]);
array_push($u8bench,$row["speller_id_9"]);
array_push($u8bench,$row["speller_id_10"]);
$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$u9";
$row=$conn->query($stmt)->fetch_assoc();
$u9score=$row["score"];
$u9tid=$row["team_id"];
array_push($u9cteam,$row["speller_id_1"]);
array_push($u9cteam,$row["speller_id_2"]);
array_push($u9cteam,$row["speller_id_3"]);
array_push($u9cteam,$row["speller_id_4"]);
array_push($u9cteam,$row["speller_id_5"]);
array_push($u9cteam,$row["speller_id_6"]);
array_push($u9bench,$row["speller_id_7"]);
array_push($u9bench,$row["speller_id_8"]);
array_push($u9bench,$row["speller_id_9"]);
array_push($u9bench,$row["speller_id_10"]);
$stmt="SELECT team_id, speller_id_1, speller_id_2, speller_id_3, speller_id_4, speller_id_5, speller_id_6, speller_id_7, speller_id_8, speller_id_9, speller_id_10, score FROM teams10 WHERE league_id=$lid AND user_id=$u10";
$row=$conn->query($stmt)->fetch_assoc();
$u10score=$row["score"];
$u10tid=$row["team_id"];
array_push($u10cteam,$row["speller_id_1"]);
array_push($u10cteam,$row["speller_id_2"]);
array_push($u10cteam,$row["speller_id_3"]);
array_push($u10cteam,$row["speller_id_4"]);
array_push($u10cteam,$row["speller_id_5"]);
array_push($u10cteam,$row["speller_id_6"]);
array_push($u10bench,$row["speller_id_7"]);
array_push($u10bench,$row["speller_id_8"]);
array_push($u10bench,$row["speller_id_9"]);
array_push($u10bench,$row["speller_id_10"]);
$conn->close();

$cstuff=array($c,$ccteam,$cbench,$cscore,$ctid);
$u2stuff=array($u2,$u2cteam,$u2bench,$u2score,$u2tid);
$u3stuff=array($u3,$u3cteam,$u3bench,$u3score,$u3tid);
$u4stuff=array($u4,$u4cteam,$u4bench,$u4score,$u4tid);
$u5stuff=array($u5,$u5cteam,$u5bench,$u5score,$u5tid);
$u6stuff=array($u6,$u6cteam,$u6bench,$u6score,$u6tid);
$u7stuff=array($u7,$u7cteam,$u7bench,$u7score,$u7tid);
$u8stuff=array($u8,$u8cteam,$u8bench,$u8score,$u8tid);
$u9stuff=array($u9,$u9cteam,$u9bench,$u9score,$u9tid);
$u10stuff=array($u10,$u10cteam,$u10bench,$u10score,$u10tid);

$allstuff=array($cstuff,$u2stuff,$u3stuff,$u4stuff,$u5stuff,$u6stuff,$u7stuff,$u8stuff,$u9stuff,$u10stuff);

function cmp ($a,$b) {
	if($a[3]>=$b[3]) {
		return -1;
	}
	else {
		return 1;
	}
}

usort($allstuff,"cmp");
$k=0;
foreach($allstuff as $currentuser) {
	if ($_SESSION["id"]===(int)($currentuser[0])) {
		$mystuff=$k;
	}
	$k=$k+1;
}
if (!(isset($mystuff))) {
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
h1{font-size:2.6rem;line-height:normal;margin-top:0;font-weight:300;}h2{font-size:1.4rem;font-weight:300;line-height:normal;margin-top:1rem;margin-bottom:.5rem}h3{font-size:1.4rem;font-weight:300;line-height:normal;margin:1rem 0 .5rem}h4{font-size:1.1rem;font-weight:500;line-height:normal;margin-bottom:.4rem}h6{font-size:1rem;font-weight:500;line-height:normal}




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
<div class="section no-pad-bot" id="index-banner">
 <div class="container">
 <br/>
 <br/>
 <h1 class="header center">Standings</h1>
<table class="bordered centered"><thead>
<tr>
<th>Name</th>
<th>Score</th>
</tr>
</thead>
<?php





$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);
if ($conn->connect_error) {
    die("Connection failed: ");
} 
$names=array();
$i=0;
foreach ($allstuff as $cuser) {
	echo "<tr>";
	$newstmt="SELECT first_name, last_name FROM users WHERE user_id=$cuser[0]";
	$row = $conn->query($newstmt)->fetch_assoc();
	array_push($names,$row["first_name"]." ".$row["last_name"]);
	echo "<td>".$names[$i]."</td>";
	echo "<td>".$cuser[3]."</td>";
	$i=$i+1;
}
$conn->close();
?>
</tr>
</table>

</div>
</div>
<div class="container">
 <br/>
 <br/>
 <h1 class="header center">Teams</h1>
 <div class="row">
 <div>
 <ul class="tabs">

<?php
$i =0;
foreach ($allstuff as $cuser) {
	echo "<li class=\"tab\"><a href=\"#team".$i."\">".$names[$i]."</a></li>\n";
	$i=$i+1;
}
?>
</ul>
<?php





$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);
if ($conn->connect_error) {
    die("Connection failed: ");
}
$i =0;
$spellernames=array();
$benchnames=array();
foreach ($allstuff as $cuser) {
echo "<div id=\"team".$i."\" class=\"col s12\">";
echo"<h3 class=\"center-align light\">Current Team</h3>";
echo"<ul class=\"collection\">";
$cspellernames=array();
foreach ($cuser[1] as $spellerid) {
	$mystmt="SELECT name, eliminated FROM spellers WHERE id=$spellerid";
	$row = $conn->query($mystmt)->fetch_assoc();
	echo "<li class=\"collection-item\"><div class=\"center-align";
	if (!($row["eliminated"])) {
				echo " green-text";
			} else {
				echo " red-text";
			}
	echo "\">".$row["name"]."</div></li>";
	array_push($cspellernames,$row["name"]);
}
echo "</ul>";
array_push($spellernames,$cspellernames);
$cbenchnames=array();
if (isset($cuser[2][0])) {
	echo"<h3 class=\"center-align light\">Bench</h3>";
	echo"<ul class=\"collection\">";
	
	foreach ($cuser[2] as $spellerid) {
		if (isset($spellerid)) {
			$mystmt="SELECT name, eliminated FROM spellers WHERE id=$spellerid";
			$row = $conn->query($mystmt)->fetch_assoc();
			echo "<li class=\"collection-item\"><div class=\"center-align";
			if (!($row["eliminated"])) {
				echo " green-text";
			} else {
				echo " red-text";
			}
			echo "\">".$row["name"]."</div></li>";
			array_push($cbenchnames,$row["name"]);
		}
	}
	
	echo "</ul>";
}
array_push($benchnames,$cbenchnames);
echo"</div>\n";
$i=$i+1;
}
$conn->close();
?>
</div>
</div>
</div>
<?php





$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);
if ($conn->connect_error) {
    die("Connection failed: ");
}
$row=$conn->query("SELECT trades FROM trades")->fetch_assoc();
if ($row["trades"]) {
include "addremove.php";
}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script src="js/select2.min.js"></script>
<script>
$(document).ready(function(){
     $(".button-collapse").sideNav( {draggable: true,closeOnClick: true});
     $('ul.tabs').tabs({  });
     $(".js-example-basic-single").select2();
});
</script>
</body>
</html>