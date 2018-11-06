<?php
session_start();
if (!(isset($_SESSION['id']) && !empty($_SESSION['id']))) {
	header("Location: index.php");
	exit();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST["leaguejoin"])) {
		$leaguename=$_POST["leaguejoin"];
		if (empty($leaguename)) {
			header("Location: newuser.php?error=empty");
			exit();
		}
	} else {
		header("Location: newuser.php");
		exit();
	}
	if (isset($_POST["join"])) {
		$join=True;
		$create=False;
	} elseif (isset($_POST["create"])){
		$join=False;
		$create=True;
	} else {
		header("Location: index.php?6");
		exit();
	}
	if ($join) {
		$configs = include('config.php');

$conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

		if ($conn->connect_error) {
    		die("Connection failed: ");
		} 
		$stmt = $conn->prepare("SELECT creatorid, user_id_2, user_id_3, user_id_4, user_id_5, user_id_6, user_id_7, user_id_8, user_id_9, user_id_10, league_id FROM leagues10 WHERE league_name=?");
		$stmt->bind_param("s", $leaguename);
		$stmt->execute();
		$stmt->bind_result($c,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10,$lid);

		if (!($stmt->fetch())) {
			$stmt->close();
			$conn->close();
			header("Location: newuser.php?error=noleague");
			exit();
		}
		$stmt->close();


		if (!(in_array($_SESSION["id"],array($c,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10),True))) {
		if(empty($u2)){
				$stmt = $conn->prepare("UPDATE leagues10 SET user_id_2=? WHERE league_id=?");
				$stmt->bind_param("ii",$_SESSION["id"],$lid);
				$stmt->execute();
				$stmt->close();
				$u2=$_SESSION["id"];
				array_push($_SESSION["leaguenames10"],$leaguename);
		array_push($_SESSION["leagueids10"],$lid);
		array_push($_SESSION["leaguedrafts10"],False);
			} elseif(empty($u3)){
				$stmt = $conn->prepare("UPDATE leagues10 SET user_id_3=? WHERE league_id=?");
				$stmt->bind_param("ii",$_SESSION["id"],$lid);
				$stmt->execute();
				$stmt->close();
				$u3=$_SESSION["id"];
				array_push($_SESSION["leaguenames10"],$leaguename);
		array_push($_SESSION["leagueids10"],$lid);
		array_push($_SESSION["leaguedrafts10"],False);
			} elseif(empty($u4)){
				$stmt = $conn->prepare("UPDATE leagues10 SET user_id_4=? WHERE league_id=?");
				$stmt->bind_param("ii",$_SESSION["id"],$lid);
				$stmt->execute();
				$stmt->close();
				$u4=$_SESSION["id"];
				array_push($_SESSION["leaguenames10"],$leaguename);
		array_push($_SESSION["leagueids10"],$lid);
		array_push($_SESSION["leaguedrafts10"],False);
			} elseif(empty($u5)){
				$stmt = $conn->prepare("UPDATE leagues10 SET user_id_5=? WHERE league_id=?");
				$stmt->bind_param("ii",$_SESSION["id"],$lid);
				$stmt->execute();
				$stmt->close();
				$u5=$_SESSION["id"];
				array_push($_SESSION["leaguenames10"],$leaguename);
		array_push($_SESSION["leagueids10"],$lid);
		array_push($_SESSION["leaguedrafts10"],False);
			} elseif(empty($u6)){
				$stmt = $conn->prepare("UPDATE leagues10 SET user_id_6=? WHERE league_id=?");
				$stmt->bind_param("ii",$_SESSION["id"],$lid);
				$stmt->execute();
				$stmt->close();
				$u6=$_SESSION["id"];
				array_push($_SESSION["leaguenames10"],$leaguename);
		array_push($_SESSION["leagueids10"],$lid);
		array_push($_SESSION["leaguedrafts10"],False);
			} elseif(empty($u7)){
				$stmt = $conn->prepare("UPDATE leagues10 SET user_id_7=? WHERE league_id=?");
				$stmt->bind_param("ii",$_SESSION["id"],$lid);
				$stmt->execute();
				$stmt->close();
				$u7=$_SESSION["id"];
				array_push($_SESSION["leaguenames10"],$leaguename);
		array_push($_SESSION["leagueids10"],$lid);
		array_push($_SESSION["leaguedrafts10"],False);
			} elseif(empty($u8)){
				$stmt = $conn->prepare("UPDATE leagues10 SET user_id_8=? WHERE league_id=?");
				$stmt->bind_param("ii",$_SESSION["id"],$lid);
				$stmt->execute();
				$stmt->close();
				$u8=$_SESSION["id"];
				array_push($_SESSION["leaguenames10"],$leaguename);
		array_push($_SESSION["leagueids10"],$lid);
		array_push($_SESSION["leaguedrafts10"],False);
			} elseif(empty($u9)){
				$stmt = $conn->prepare("UPDATE leagues10 SET user_id_9=? WHERE league_id=?");
				$stmt->bind_param("ii",$_SESSION["id"],$lid);
				$stmt->execute();
				$stmt->close();
				$u9=$_SESSION["id"];
				array_push($_SESSION["leaguenames10"],$leaguename);
		array_push($_SESSION["leagueids10"],$lid);
		array_push($_SESSION["leaguedrafts10"],False);
			} elseif(empty($u10)){
				$stmt = $conn->prepare("UPDATE leagues10 SET user_id_10=? WHERE league_id=?");
				$stmt->bind_param("ii",$_SESSION["id"],$lid);
				$stmt->execute();
				$stmt->close();
				$u10=$_SESSION["id"];
				array_push($_SESSION["leaguenames10"],$leaguename);
		array_push($_SESSION["leagueids10"],$lid);
		array_push($_SESSION["leaguedrafts10"],False);
			} else {
				$conn->close();
				header("Location: newuser.php?error=nospace");
				exit();
			} 
		}else {
			$conn->close();
			header("Location: drafting10.php?lid=$lid");
			exit();
		}

		$conn->close();

	} elseif ($create) {
		
		
		
		

		$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

		if ($conn->connect_error) {
 		   die("Connection failed: ");
		} 
		$stmt = $conn->prepare("SELECT * FROM leagues10 WHERE league_name=?");
		$stmt->bind_param("s", $leaguename);
		$stmt->execute();
		if ($stmt->fetch()) {
			$stmt->close();
			$conn->close();
			header("Location: newuser.php?error=exists");
			exit();
		}
		$stmt = $conn->prepare("INSERT INTO leagues10 VALUES(?,?, NULL, NULL, NULL, NULL, NULL,NULL,NULL,NULL,NULL,NULL, FALSE)");
		$stmt->bind_param("si", $leaguename, $_SESSION['id']);
		$stmt->execute();
		$stmt->close();
		$u2="";
		$u3="";
		$u4="";
		$u5="";
		$c=$_SESSION["id"];
		$lid=$conn->insert_id;
		$conn->close();
		array_push($_SESSION["leaguenames"],$leaguename);
		array_push($_SESSION["leagueids"],$lid);
		array_push($_SESSION["leaguedrafts"],False);
	}
} elseif ($_SERVER["REQUEST_METHOD"] === "GET"){
	if (isset($_GET['lid']) && !empty($_GET["lid"])) {
  		if (null === ($lid = filter_input(INPUT_GET, 'lid', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE))) {
  			header("Location: index.php?2");
			exit();
		} 
	} else {
		header("Location: index.php?3");
		exit();
	}
	
	
	
	

	$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

	if ($conn->connect_error) {
		die("Connection failed: ");
	} 
	$stmt = $conn->prepare("SELECT league_name, creatorid, user_id_2, user_id_3, user_id_4, user_id_5, user_id_6, user_id_7, user_id_8, user_id_9, user_id_10  FROM leagues10 WHERE league_id=?");
	$stmt->bind_param("i", $lid);
	$stmt->execute();
	$stmt->bind_result($leaguename,$c,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10);
	if (!($stmt->fetch())) {
		$stmt->close();
		$conn->close();
		header("Location: newuser.php?error=noleague");
		exit();
	}
	$stmt->close();
	$conn->close();
	if (!(in_array($_SESSION["id"],array($c,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10),True))) {
		header("Location: index.php?17");
		exit();
	}
}
if (!empty($u10)) {
	header("Location: draft10.php?lid=$lid");
	exit();
}
include "navbar.php";
?>


<div class="section no-pad-bot" id="index-banner">
 <div class="container">
 <br/>
 <br/>
 <h1 class="header center">Current members</h1>
 <div class="row center">
       <h3 class="header col s12 light">Get remaining members to sign up using the league name:<br/><?php echo  htmlspecialchars($leaguename)?></h3>
        <br/>
        <h3 class="header col s12 light">The league must have 10 players.</h3>
 </div>
 <br/><br/>
<div class="divider"></div>
<br/>
<br/>
<table class="responsive-table">
		<thead>
		<tr>
		<th>Name</th>
		<th>Username</th>
		</tr>
		</thead>
		<tr>
		<?php 
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			$conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);
			
			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$c);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");

		?>
		</tr>
		<tr>
		<?php 
		if (!empty($u2)) {
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$u2);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");
		}
		?>
		</tr>
		<tr>
		<?php 
		if (!empty($u3)) {
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$u3);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");
		}
		?>
		</tr>
		<tr>
		<?php 
		if (!empty($u4)) {
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$u4);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");
		}
		?>
		</tr>
		<tr>
		<?php 
		if (!empty($u5)) {
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$u5);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");
		}
		?>
		</tr>
		<tr>
		<?php 
		if (!empty($u6)) {
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$u6);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");
		}
		?>
		</tr>
		<tr>
		<?php 
		if (!empty($u7)) {
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$u7);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");
		}
		?>
		</tr>
		<tr>
		<?php 
		if (!empty($u8)) {
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$u8);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");
		}
		?>
		</tr>
		<tr>
		<?php 
		if (!empty($u9)) {
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$u9);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");
		}
		?>
		</tr>
		<tr>
		<?php 
		if (!empty($u10)) {
			
			
			
			

			$configs = include('config.php');  $conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

			if ($conn->connect_error) {
				die("Connection failed: ");
			} 
			$stmt=$conn->prepare("SELECT first_name, last_name, username FROM users WHERE user_id=?");
			$stmt->bind_param("i",$u10);
			$stmt->execute();
			$stmt->bind_result($first,$last,$user);
			if (!($stmt->fetch())) {
				$stmt->close();
				$conn->close();
				header("Location: index.php");
				exit();
			}
			$stmt->close();
			$conn->close();
			echo("<td>".htmlspecialchars($first)." ".htmlspecialchars($last)."</td><td>".htmlspecialchars($user)."</td>");
		}
		?>
		</tr>
</table>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>
$(document).ready(function(){
     $(".button-collapse").sideNav( {draggable: true,closeOnClick: true});
});
</script>
</body>
</html>
