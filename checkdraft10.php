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
	$u2team=$_POST["user2"];
	$u3team=$_POST["user3"];
	$u4team=$_POST["user4"];
	$u5team=$_POST["user5"];
	$u6team=$_POST["user6"];
	$u7team=$_POST["user7"];
	$u8team=$_POST["user8"];
	$u9team=$_POST["user9"];
	$u10team=$_POST["user10"];

	if (count($cteam)<6 || count($cteam)>10 || count($u2team)<6 || count($u2team)>10 || count($u3team)<6 || count($u3team)>10 || count($u4team)<6 || count($u4team)>10 || count($u5team)<6 || count($u5team)>10 || count($u6team)<6 || count($u6team)>10 || count($u7team)<6 || count($u7team)>10 || count($u8team)<6 || count($u8team)>10 || count($u9team)<6 || count($u9team)>10 || count($u10team)<6 || count($u10team)>10){
		echo"hi";
		header("Location: draft10.php?lid=$lid&e=t");
		exit();
	}

}
$players= array_merge($cteam, $u2team, $u3team, $u4team, $u5team, $u6team, $u7team, $u8team, $u9team, $u10team);
$dupe_array=array();
foreach($players as $val) {
	if (isset($dupe_array[$val])) {
	    header("Location: draft10.php?lid=$lid&e=dupes");
		exit();
	} else { 
	    $dupe_array[$val]=1;
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
for ($i=count($u6team);$i<10;$i++) {
	array_push($u6team, "NULL");
}
for ($i=count($u7team);$i<10;$i++) {
	array_push($u7team, "NULL");
}
for ($i=count($u8team);$i<10;$i++) {
	array_push($u8team, "NULL");
}
for ($i=count($u9team);$i<10;$i++) {
	array_push($u9team, "NULL");
}
for ($i=count($u10team);$i<10;$i++) {
	array_push($u10team, "NULL");
}
$servername="localhost";
$username= "id1634423_arihant";
$password="ajain123";
$database="id1634423_users";

$conn = new mysqli($servername, $username, $password,$database);

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
		header("Location: newuser10.php?error=noleague");
		exit();
	}
	$stmt->close();
	if ($has_drafted) {
		header("Location: index.php");
		exit();
	}
if ($_SESSION["id"]!== $c) {
	$conn->close();
	header("index.php");
	exit();
}

$newstmt="INSERT INTO teams10 (user_id,league_id,team_id,speller_id_1,speller_id_2,speller_id_3,speller_id_4,speller_id_5,speller_id_6,speller_id_7,speller_id_8,speller_id_9,speller_id_10,score) VALUES ($c,$lid, NULL,$cteam[0],$cteam[1],$cteam[2],$cteam[3],$cteam[4],$cteam[5],$cteam[6],$cteam[7],$cteam[8],$cteam[9],0),($u2,$lid, NULL,$u2team[0],$u2team[1],$u2team[2],$u2team[3],$u2team[4],$u2team[5],$u2team[6],$u2team[7],$u2team[8],$u2team[9],0),($u3,$lid, NULL,$u3team[0],$u3team[1],$u3team[2],$u3team[3],$u3team[4],$u3team[5],$u3team[6],$u3team[7],$u3team[8],$u3team[9],0),($u4,$lid, NULL,$u4team[0],$u4team[1],$u4team[2],$u4team[3],$u4team[4],$u4team[5],$u4team[6],$u4team[7],$u4team[8],$u4team[9],0),($u5,$lid, NULL,$u5team[0],$u5team[1],$u5team[2],$u5team[3],$u5team[4],$u5team[5],$u5team[6],$u5team[7],$u5team[8],$u5team[9],0),($u6,$lid, NULL,$u6team[0],$u6team[1],$u6team[2],$u6team[3],$u6team[4],$u6team[5],$u6team[6],$u6team[7],$u6team[8],$u6team[9],0),($u7,$lid, NULL,$u7team[0],$u7team[1],$u7team[2],$u7team[3],$u7team[4],$u7team[5],$u7team[6],$u7team[7],$u7team[8],$u7team[9],0),($u8,$lid, NULL,$u8team[0],$u8team[1],$u8team[2],$u8team[3],$u8team[4],$u8team[5],$u8team[6],$u8team[7],$u8team[8],$u8team[9],0),($u9,$lid, NULL,$u9team[0],$u9team[1],$u9team[2],$u9team[3],$u9team[4],$u9team[5],$u9team[6],$u9team[7],$u9team[8],$u9team[9],0),($u10,$lid, NULL,$u10team[0],$u10team[1],$u10team[2],$u10team[3],$u10team[4],$u10team[5],$u10team[6],$u10team[7],$u10team[8],$u10team[9],0);";
$conn->query($newstmt);
$k=array_search ($leaguename,$_SESSION["leaguenames10"]);
$_SESSION["leaguedrafts10"][$k]=True;
$newstmt="UPDATE leagues10 SET has_drafted=True WHERE league_id=$lid";
$conn->query($newstmt);
$conn->close();
header("Location: scores10.php?lid=$lid");
exit();
?>