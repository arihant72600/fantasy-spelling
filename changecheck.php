<?php
session_start();
if (!(isset($_SESSION['id']) && !empty($_SESSION['id']))) {
	header("Location: index.php");
	exit();
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
if (isset($_GET['t']) && !empty($_GET['t'])) {
	if ($_GET['t']==="t") {
		$ten=True;
	}
	if ($_GET['t']==="f") {
		$ten=False;
	} else {
		header("Location: index.php?8");
		exit();
	}	
} else {
	header("Location: index.php?8");
	exit();
}
if (isset($_POST["add"])) {
	echo "add";
} else if (isset($_POST["remove"])) {
	echo "remove";
} else if (isset($_POST["subsitute"])) {
	echo "subsitute";
}
?>