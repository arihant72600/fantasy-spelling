<?php
session_start();
if (!(isset($_SESSION['id']) && !empty($_SESSION['id']))) {
	header("Location: index.php");
	exit();
}
if (isset($_GET['lid']) && !empty($_GET["lid"])) {
  		if (null === ($lid = filter_input(INPUT_GET, 'lid', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE))) {
  			header("Location: index.php?2");
			exit();
		} 
	} else {
		header("Location: index.php?3");
		exit();
	}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$cteam=$_POST["user1"];
	$cteam=$_POST["user2"];
	$cteam=$_POST["user3"];
	$cteam=$_POST["user4"];
	$cteam=$_POST["user5"];
	$cteam=$_POST["user6"];
	$cteam=$_POST["user7"];
	$cteam=$_POST["user8"];
	$cteam=$_POST["user9"];
	$cteam=$_POST["user10"];

	if ((count($cteam)<6 || count($cteam)>10) && (count($u2team)<6 || count($u2team)>10) && (count($u3team)<6 || count($u3team)>10) && (count($u4team)<6 || count($u4team)>10) && (count($u5team)<6 || count($u5team)>10)) {
		header("Location: draft.php?lid=$lid&e=nbst");
		exit();
	}
}
for ($i=count($cteam);$i<10;$i++) {
	array_push($cteam, "NULL");
}
for ($i=count($u2team);$i<10;$i++) {
	array_push($u2team, "NULL");
}
for ($i=count($u3team);$i<10;$i++) {
	array_push($u3team, "NULL");
}
for ($i=count($u4team);$i<10;$i++) {
	array_push($u4team, "NULL");
}
for ($i=count($u5team);$i<10;$i++) {
	array_push($u5team, "NULL");
}
$configs = include('config.php');

$conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

if ($conn->connect_error) {
 	  die("Connection failed: ");
} 



$stmt = $conn->prepare("SELECT league_name, creatorid, user_id_2, user_id_3, user_id_4, user_id_5 FROM leagues WHERE league_id=?");
	$stmt->bind_param("i", $lid);
	$stmt->execute();
	$stmt->bind_result($leaguename,$c,$u2,$u3,$u4,$u5);
	if (!($stmt->fetch())) {
		$stmt->close();
		$conn->close();
		header("Location: newuser.php?error=noleague");
		exit();
	}
	$stmt->close();
if ($_SESSION["id"]!== $c) {
	$conn->close();
	header("index.php");
	exit();
}
$newstmt="INSERT INTO teams (user_id,league_id,team_id,speller_id_1,speller_id_2,speller_id_3,speller_id_4,speller_id_5,speller_id_6,speller_id_7,speller_id_8,speller_id_9,speller_id_10,score) VALUES ($c,$lid, NULL,$cteam[0],$cteam[1],$cteam[2],$cteam[3],$cteam[4],$cteam[5],$cteam[6],$cteam[7],$cteam[8],$cteam[9],0),($u2,$lid, NULL,$u2team[0],$u2team[1],$u2team[2],$u2team[3],$u2team[4],$u2team[5],$u2team[6],$u2team[7],$u2team[8],$u2team[9],0),($u3,$lid, NULL,$u3team[0],$u3team[1],$u3team[2],$u3team[3],$u3team[4],$u3team[5],$u3team[6],$u3team[7],$u3team[8],$u3team[9],0),($u4,$lid, NULL,$u4team[0],$u4team[1],$u4team[2],$u4team[3],$u4team[4],$u4team[5],$u4team[6],$u4team[7],$u4team[8],$u4team[9],0),($u5,$lid, NULL,$u5team[0],$u5team[1],$u5team[2],$u5team[3],$u5team[4],$u5team[5],$u5team[6],$u5team[7],$u5team[8],$u5team[9],0);";
$conn->query($newstmt);
$k=array_search ($leaguename,$_SESSION["leaguenames"]);
$_SESSION["leaguedrafts"][$k]=True;
$newstmt="UPDATE leagues SET has_drafted=True WHERE league_id=$lid";
$conn->query($newstmt);
$conn->close();
header("Location: scores.php?lid=$lid");
exit();
?>