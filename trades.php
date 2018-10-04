<?php 
session_start();

if (!($_SESSION["uName"]==="arihant")) {
	header("Location: index.php");
	exit();
}

if (isset($_GET["c"])) {
	if ($_GET["c"]==="t") {
		$GLOBALS["c"]=True;
	} else if ($_GET["c"]==="f") {
		$GLOBALS["c"]=False;
	}
}
echo($GLOBALS["c"]);

?>