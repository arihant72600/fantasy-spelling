<?php
session_start();
if (!(isset($_SESSION['id']) && !empty($_SESSION['id']))) {
	header("Location: index.php?4");
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
$servername="localhost";
$username= "id1634423_arihant";
$password="ajain123";
$database="id1634423_users";

$conn = new mysqli($servername, $username, $password,$database);

if ($conn->connect_error) {
	die("Connection failed: ");
} 
$trades=$conn->query("SELECT * FROM trades")->fetch_assoc()["trades"];
$conn->close();
if (!$trades) {
	if($ten) {
		header("Location: scores10.php?lid=$lid");
		exit();
	} else {
		header("Location: scores.php?lid=$lid");
		exit();
	}
}
if (isset($_GET['t']) && !empty($_GET['t'])) {
	if ($_GET['t']==="t") {
		$ten=True;
	}
	 else if ($_GET['t']==="f") {
		$ten=False;
	} else {
		header("Location: index.php?9");
		exit();
	}	
} else {
	header("Location: index.php?10");
	exit();
}
if (isset($_POST["add"])) {
	$servername="localhost";
	$username= "id1634423_arihant";
	$password="ajain123";
	$database="id1634423_users";

	$conn = new mysqli($servername, $username, $password,$database);

	if ($conn->connect_error) {
		die("Connection failed: ");
	} 
	$myid=$_SESSION["id"];
	$toadd=$_POST['addspeller'];
	if ($ten) {

		$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE user_id=$myid AND league_id=$lid";
		$row=$conn->query($stmt)->fetch_assoc();
		for ($i=7; $i<11;$i++) {
			if (!isset($row["speller_id_$i"]) || empty($row["speller_id_$i"])) {
				$stmt="UPDATE teams10 SET speller_id_$i=$toadd WHERE user_id=$myid AND league_id=$lid";
				$conn->query($stmt);
				break;
			}
		}
		$conn->close();
		header("Location: scores10.php?lid=$lid");
		exit();
	}
	else if (!($ten)) {
		$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams WHERE user_id=$myid AND league_id=$lid";
		$row=$conn->query($stmt)->fetch_assoc();
		for ($i=7; $i<11;$i++) {
			if (!isset($row["speller_id_$i"]) || empty($row["speller_id_$i"])) {
				$stmt="UPDATE teams SET speller_id_$i=$toadd WHERE user_id=$myid AND league_id=$lid";
				$conn->query($stmt);
				break;
			}
		}
		$conn->close();
		header("Location: scores.php?lid=$lid");
		exit();
	}
} else if (isset($_POST["remove"])) {
	$servername="localhost";
	$username= "id1634423_arihant";
	$password="ajain123";
	$database="id1634423_users";

	$conn = new mysqli($servername, $username, $password,$database);

	if ($conn->connect_error) {
		die("Connection failed: ");
	} 
	$myid=$_SESSION["id"];

	if ($ten) {
		if (isset($_POST["benchr"])) {
			$stmt="SELECT team_id,speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE user_id=$myid AND league_id=$lid";
			$row=$conn->query($stmt)->fetch_assoc();
			$mytid=$row["team_id"];
			$cbench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($cbench,$row["speller_id_$i"]);
				}
			}
			$inum=count($cbench)+7;
			$removenums=array(False,False,False,False);
			foreach($_POST["benchr"] as $toremove) {
				$num=(int)($toremove[6])-7;
				if ($num===-6) {
					$num=3;
				}
				unset($cbench[$num]);
				$removenums[$num]=True;
			}
			$i=7;
			foreach ($cbench as $updateinb) {
				$stmt="UPDATE teams10 SET speller_id_$i=$updateinb WHERE user_id=$myid AND league_id=$lid";
				$conn->query($stmt);
				$i++;
			}
			while ($i<11) {
				$stmt="UPDATE teams10 SET speller_id_$i=NULL WHERE user_id=$myid AND league_id=$lid";
				$conn->query($stmt);
				$i++;
			}
			$allreadyremoved=0;
			
			for($i=7; $i<11;$i++) {
				if ($removenums[$i-7]) {
					$allreadyremoved++;
					$conn->query("DELETE FROM offers WHERE team_1_speller_$i=1 AND team_id_1=$mytid AND ten=True");
					$conn->query("DELETE FROM offers WHERE team_2_speller_$i=1 AND team_id_2=$mytid AND ten=True");

				} else if ($i<$inum){
					if ($allreadyremoved!==0) {
						$conn->query("UPDATE offers SET team_1_speller_$i=0, team_1_speller_".($i-$allreadyremoved)."=1 WHERE team_1_speller_$i=1 AND team_id_1=$mytid AND ten=True");
						$conn->query("UPDATE offers SET team_2_speller_$i=0, team_2_speller_".($i-$allreadyremoved)."=1 WHERE team_2_speller_$i=1 AND team_id_2=$mytid AND ten=True");
					}
				}
			}
		}
		$conn->close();
		header("Location: scores10.php?lid=$lid");
		exit();

	} else if (!$ten) {
		if (isset($_POST["benchr"])) {
			$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams WHERE user_id=$myid AND league_id=$lid";
			$row=$conn->query($stmt)->fetch_assoc();
			$cbench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($cbench,$row["speller_id_$i"]);
				}
			}
			foreach($_POST["benchr"] as $toremove) {
				$num=$toremove[6]-7;
				if ($num===-6) {
					$num=3;
				}
				unset($cbench[$num]);
			}
			$i=7;
			foreach ($cbench as $updateinb) {
				$stmt="UPDATE teams SET speller_id_$i=$updateinb WHERE user_id=$myid AND league_id=$lid";
				echo $stmt;
				$conn->query($stmt);
				$i++;
			}
			while ($i<11) {
				$stmt="UPDATE teams SET speller_id_$i=NULL WHERE user_id=$myid AND league_id=$lid";
				echo $stmt;
				$conn->query($stmt);
				$i++;
			}
		}
		$conn->close();
		header("Location: scores.php?lid=$lid");
		exit();
	}
	
} else if (isset($_POST["subsitute"])) {
	if (isset($_POST["bench"]) && isset($_POST["speller"])) {
		$servername="localhost";
		$username= "id1634423_arihant";
		$password="ajain123";
		$database="id1634423_users";

		$conn = new mysqli($servername, $username, $password,$database);

		if ($conn->connect_error) {
			die("Connection failed: ");
		} 
		$myid=$_SESSION["id"];
		$benchplace=$_POST["bench"][5];
		if ($benchplace==="1") {
			$benchplace=10;
		}
		$spellerplace=$_POST["speller"][7];
		if($ten) {
			$stmt= "SELECT speller_id_$benchplace,speller_id_$spellerplace FROM teams10 WHERE user_id=$myid AND league_id=$lid";
			$row=$conn->query($stmt)->fetch_assoc();
			$benchid=$row["speller_id_$benchplace"];
			$spellerid=$row["speller_id_$spellerplace"];
			$replacebench="UPDATE teams10 SET speller_id_$benchplace=$spellerid WHERE user_id=$myid AND league_id=$lid";
			$replacespeller="UPDATE teams10 SET speller_id_$spellerplace=$benchid WHERE user_id=$myid AND league_id=$lid";
			$conn->query($replacebench);
			$conn->query($replacespeller);

			$mytid=$conn->query("SELECT team_id FROM teams10 WHERE user_id=$myid AND league_id=$lid")->fetch_assoc()["team_id"];
			$conn->query("UPDATE offers SET team_1_speller_$benchplace=team_1_speller_$spellerplace+team_1_speller_$benchplace, team_1_speller_$spellerplace=team_1_speller_$benchplace-team_1_speller_$spellerplace,team_1_speller_$benchplace=team_1_speller_$benchplace-team_1_speller_$spellerplace  WHERE ten=True AND team_id_1=$mytid");
			$conn->query("UPDATE offers SET team_2_speller_$benchplace=team_2_speller_$spellerplace+team_2_speller_$benchplace, team_2_speller_$spellerplace=team_2_speller_$benchplace-team_2_speller_$spellerplace,team_2_speller_$benchplace=team_2_speller_$benchplace-team_2_speller_$spellerplace  WHERE ten=True AND team_id_2=$mytid");
			$conn->close();
		    header("Location: scores10.php?lid=$lid");
			exit();
			
		} else {
			$stmt= "SELECT speller_id_$benchplace,speller_id_$spellerplace FROM teams WHERE user_id=$myid AND league_id=$lid";
			$row=$conn->query($stmt)->fetch_assoc();
			$benchid=$row["speller_id_$benchplace"];
			$spellerid=$row["speller_id_$spellerplace"];
			$replacebench="UPDATE teams SET speller_id_$benchplace=$spellerid WHERE user_id=$myid AND league_id=$lid";
			$replacespeller="UPDATE teams SET speller_id_$spellerplace=$benchid WHERE user_id=$myid AND league_id=$lid";
			$conn->query($replacebench);
			$conn->query($replacespeller);

			$mytid=$conn->query("SELECT team_id FROM teams WHERE user_id=$myid AND league_id=$lid")->fetch_assoc()["team_id"];
			$conn->query("UPDATE offers SET team_1_speller_$benchplace=0, team_1_speller_$spellerplace=1 WHERE ten=False AND team_id_1=$mytid AND team_1_speller_$benchplace=1 AND team_1_speller_$spellerplace=0");
			$conn->query("UPDATE offers SET team_1_speller_$benchplace=1, team_1_speller_$spellerplace=0 WHERE ten=False AND team_id_1=$mytid AND team_1_speller_$benchplace=0 AND team_1_speller_$spellerplace=1");
			$conn->query("UPDATE offers SET team_2_speller_$benchplace=0, team_2_speller_$spellerplace=1 WHERE ten=False AND team_id_2=$mytid AND team_2_speller_$benchplace=1 AND team_2_speller_$spellerplace=0");
			$conn->query("UPDATE offers SET team_2_speller_$benchplace=1, team_2_speller_$spellerplace=0 WHERE ten=False AND team_id_2=$mytid AND team_2_speller_$benchplace=0 AND team_2_speller_$spellerplace=1");

			$conn->close();
			header("Location: scores.php?lid=$lid");
			exit();
		}
		
	} else {
		if($ten) {
			header("Location: scores10.php?lid=$lid");
			exit();
		} else {
			header("Location: scores.php?lid=$lid");
			exit();
		}
	}
}

if ($ten) {
	for ($k=0; $k<10;$k++) {
		if (isset($_POST["tradewith$k"])) {
			$tradewith=$k;
		}
	}
} else {
	for ($k=0; $k<5;$k++) {
		if (isset($_POST["tradewith$k"])) {
			$tradewith=$k;
		}
	}
}
if (!isset($tradewith)) {
	if($ten) {
		header("Location: scores10.php?lid=$lid");
		exit();
	} else {
		header("Location: scores.php?lid=$lid");
		exit();
	}
}
if (!isset($_POST["mytrade$tradewith"]) || !isset($_POST["otrade$tradewith"])) {
	if($ten) {
		header("Location: scores10.php?lid=$lid");
		exit();
	} else {
		header("Location: scores.php?lid=$lid");
		exit();
	}
}
$spellersgive=$_POST["mytrade$tradewith"];
$spellerstake=$_POST["otrade$tradewith"];

$giving=array("False","False","False","False","False","False","False","False","False","False");
$taking=array("False","False","False","False","False","False","False","False","False","False");
foreach ($spellersgive as $textofgive) {
	$giving[$textofgive[8]]="True";
}
foreach ($spellerstake as $textoftake) {
	$taking[$textoftake[7]]="True";
}
$giving=array("False","False","False","False","False","False","False","False","False","False");
$taking=array("False","False","False","False","False","False","False","False","False","False");
foreach ($spellersgive as $textofgive) {
	$giving[$textofgive[8]]="True";
}
foreach ($spellerstake as $textoftake) {
	$taking[$textoftake[7]]="True";
}

if (isset($_POST["oid$tradewith"])) {
	$oid=$_POST["oid$tradewith"];
}
$myid=$_SESSION["id"];
$servername="localhost";
$username= "id1634423_arihant";
$password="ajain123";
$database="id1634423_users";

$conn = new mysqli($servername, $username, $password,$database);

if ($conn->connect_error) {
	die("Connection failed: ");
} 
if ($ten) {
	$fstmt="SELECT team_id FROM teams10 WHERE user_id=$myid AND league_id=$lid";
	$sstmt="SELECT team_id FROM teams10 WHERE user_id=$oid AND league_id=$lid";
	$mytid=$conn->query($fstmt)->fetch_assoc()["team_id"];
	$otid=$conn->query($sstmt)->fetch_assoc()["team_id"];

	$tstmt="INSERT INTO offers VALUES (NULL,True,$mytid,$otid,".$giving[0].",".$giving[1].",".$giving[2].",".$giving[3].",".$giving[4].",".$giving[5].",".$giving[6].",".$giving[7].",".$giving[8].",".$giving[9].",".$taking[0].",".$taking[1].",".$taking[2].",".$taking[3].",".$taking[4].",".$taking[5].",".$taking[6].",".$taking[7].",".$taking[8].",".$taking[9].")";

	$conn->query($tstmt);

} else {
	$fstmt="SELECT team_id FROM teams WHERE user_id=$myid AND leauge_id=$lid";
	$sstmt="SELECT team_id FROM teams WHERE user_id=$oid AND league_id=$lid";
	
	$mytid=$conn->query($fstmt)->fetch_assoc()["team_id"];
	$otid=$conn->query($sstmt)->fetch_assoc()["team_id"];

	$tstmt="INSERT INTO offers VALUES (NULL,False,$mytid,$otid,".$giving[0].",".$giving[1].",".$giving[2].",".$giving[3].",".$giving[4].",".$giving[5].",".$giving[6].",".$giving[7].",".$giving[8].",".$giving[9].",".$taking[0].",".$taking[1].",".$taking[2].",".$taking[3].",".$taking[4].",".$taking[5].",".$taking[6].",".$taking[7].",".$taking[8].",".$taking[9].")";

	$conn->query($tstmt);
	
}
$conn->close();
if($ten) {
		header("Location: scores10.php?lid=$lid");
		exit();
	} else {
		header("Location: scores.php?lid=$lid");
		exit();
	}
?>