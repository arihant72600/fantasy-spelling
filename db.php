<?php
session_start();
if (isset($_SESSION["id"])) {
	header("Location: index.php");
	exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['FirstName']) &&!empty($_POST["FirstName"])) {
  	$FirstName=$_POST['FirstName'];
  	if (!preg_match("/^[a-zA-Z ]*$/",$FirstName)) {
  		header("Location: index.php?1");
  		exit(); 
  	}
  } else {
  	header("Location: index.php?13");
  	exit();
  }
  if (isset($_POST['LastName']) &&!empty($_POST["LastName"])) {
  	$LastName=$_POST['LastName'];
  	if (!preg_match("/^[a-zA-Z ]*$/",$LastName)) {
  		header("Location: index.php?12");
  		exit();
  	}
  } else {
  	header("Location: index.php?11");
  	exit();
  }
  if (isset($_POST['uname']) && !empty($_POST["uname"])) {
  	$uname=$_POST['uname'];
  	if (!ctype_alnum ($uname)) {
  		header("Location: index.php?10");
  		exit();
  	}
  } else {
  	header("Location: index.php?9");
  	exit();
  }
   if (isset($_POST['uname']) && !empty($_POST["uname"])) {
  	$uname=$_POST['uname'];
  	if (!(ctype_alnum($uname))) {
  		header("Location: index.php?8");
  		exit();
  	}
  } else {
  	header("Location: index.php?7");
  	exit();
  }
  if (isset($_POST['password']) && !empty($_POST["password"])) {
  	$pword=$_POST['password'];
  } else {
  	header("Location: index.php?6");
  	exit();
  }
  if (isset($_POST['passwordagain']) && !empty($_POST["passwordagain"])) {
  	$passwordagain=$_POST['passwordagain'];
  } else {
  	header("Location: index.php?5");
  	exit();
  }
} else {
	header("Location: index.php?4");
  	exit();
}
if ($passwordagain!==$pword) {
	header("Location: index.php?3");
  	exit();
}
$configs = include('config.php');

$conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ");
} 
$stmt = $conn->prepare("SELECT username FROM users WHERE username=?");
$stmt->bind_param("s", $uname);
$stmt->execute();
$stmt->bind_result($result);
if ($stmt->fetch()) {
	header("Location: signup.php?first=$FirstName&last=$LastName&u=error");
	exit();
}
$stmt->close();
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
$salt = sprintf("$2a$%02d$", 10) . $salt;
$hash = crypt($pword, $salt);
$stmt = $conn->prepare("INSERT INTO users VALUES(?,?,?,?,NULL)");
$stmt->bind_param("ssss", $FirstName,$LastName,$uname,$hash);
$stmt->execute();
$_SESSION["id"]=$conn->insert_id;
$_SESSION["fName"]=$FirstName;
$_SESSION["lName"]=$LastName;
$_SESSION["uName"]=$uname;
$_SESSION["leaguenames"]=array();
$_SESSION["leagueids"]=array();
$_SESSION["leaguedrafts"]=array();
$_SESSION["leaguenames10"]=array();
$_SESSION["leagueids10"]=array();
$_SESSION["leaguedrafts10"]=array();
setcookie("id", $conn->insert_id, time() + (86400 * 30), "/");
setcookie("fName", $FirstName, time() + (86400 * 30), "/");
setcookie("lName", $LastName, time() + (86400 * 30), "/");
setcookie("uName", $uname, time() + (86400 * 30), "/");
$conn->close();
header("Location: index.php?2");
exit();
?>