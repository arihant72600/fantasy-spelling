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
	$stmt = $conn->prepare("SELECT league_name, creatorid, user_id_2, user_id_3, user_id_4, user_id_5, has_drafted FROM leagues WHERE league_id=?");
	$stmt->bind_param("i", $lid);
	$stmt->execute();
	$stmt->bind_result($leaguename,$c,$u2,$u3,$u4,$u5,$has_drafted);
	
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
	if (empty($u5)) {
		header("Location: index.php");
	}
	if (!(in_array($_SESSION["id"],array($c,$u2,$u3,$u4,$u5),True))) {
		header("Location: index.php?17");
		exit();
	}
	$ct=($c===$_SESSION["id"]);
} else {
	header("Location: index.php");
	exit();
}


include "navbar.php";
if ($ct) {
	include "draftc.php";
} elseif(!$ct) {
	include "draftnc.php";
}
?>
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>
$(document).ready(function(){
     $(".button-collapse").sideNav( {draggable: true,closeOnClick: true});
});
</script>
</body>
</html>