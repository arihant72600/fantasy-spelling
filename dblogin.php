<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["username"])) {
		$uname = $_POST["username"];
	} else {
		header("Location: index.php");
		exit();
	}
	if (isset($_POST["password"])) {
		$p = $_POST["password"];
	} else {
		header("Location: index.php");
		exit();
	}
} else {
	header("Location: index.php");
	exit();
}
$servername="localhost";
$username= "id1634423_arihant";
$password="ajain123";
$database="id1634423_users";

$conn = new mysqli($servername, $username, $password,$database);

if ($conn->connect_error) {
    die("Connection failed: ");
} 
$stmt = $conn->prepare("SELECT first_name, last_name, user_id, hash FROM users WHERE username=?");
$stmt->bind_param("s", $uname);
$stmt->execute();
$stmt->bind_result($f,$l,$i,$h);
if (!($stmt->fetch())) {
	header("Location: index.php?uop=e");
	exit();
}
if (password_verify ($p, $h )) {
	$_SESSION["id"]=$i;
	$_SESSION["fName"]=$f;
	$_SESSION["lName"]=$l;
	$_SESSION["uName"]=$uname;
	setcookie("id", $i, time() + (86400 * 30), "/");
	setcookie("fName", $f, time() + (86400 * 30), "/");
	setcookie("lName", $l, time() + (86400 * 30), "/");
	setcookie("uName", $uname, time() + (86400 * 30), "/");
} else {
	header("Location: index.php?uop=e");
	exit();
}
$stmt->close();
$_SESSION["leaguenames"]=array();
$_SESSION["leagueids"]=array();
$_SESSION["leaguedrafts"]=array();
$_SESSION["leaguenames10"]=array();
$_SESSION["leagueids10"]=array();
$_SESSION["leaguedrafts10"]=array();
$id=$_SESSION["id"];
$stmt="SELECT league_name, league_id, has_drafted FROM leagues WHERE creatorid=$id OR user_id_2=$id OR user_id_3=$id OR user_id_4=$id OR user_id_5=$id";
$result=$conn->query($stmt);
if ($result->num_rows>0) {
	while($row=$result->fetch_assoc()) {
		array_push($_SESSION["leaguenames"],$row["league_name"]);
		array_push($_SESSION["leagueids"],$row["league_id"]);
		array_push($_SESSION["leaguedrafts"],$row["has_drafted"]);
	}
}
$stmt="SELECT league_name, league_id, has_drafted FROM leagues10 WHERE creatorid=$id OR user_id_2=$id OR user_id_3=$id OR user_id_4=$id OR user_id_5=$id OR user_id_6=$id OR user_id_7=$id OR user_id_8=$id OR user_id_9=$id OR user_id_10=$id";
$result=$conn->query($stmt);
if ($result->num_rows>0) {
	while($row=$result->fetch_assoc()) {
		array_push($_SESSION["leaguenames10"],$row["league_name"]);
		array_push($_SESSION["leagueids10"],$row["league_id"]);
		array_push($_SESSION["leaguedrafts10"],$row["has_drafted"]);
	}
}
$conn->close();
header("Location: index.php");
exit();
?>