<?php 
session_start();
if (!(isset($_SESSION["id"]))) {
	header("Location: index.php");
}
if (isset($_GET['offerid']) && !empty($_GET["offerid"])) {
  	if (null === ($offerid = filter_input(INPUT_GET, 'offerid', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE))) {
  		header("Location: index.php?7");
  		exit();
	} 
} else {
	header("Location: index.php?8");
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
if ($_GET["accept"]==="t") {
	$accept=True;
} else if ($_GET["accept"]==="f") {
	$accept=False;
} else {
	header("Location: index.php?8");
	exit();
}
if ($_GET["ten"]==="True") {
	$ten=True;
	$tens="True";
} else if ($_GET["ten"]==="False") {
	$ten=False;
	$tens="False";
} else {
	header("Location: index.php?8");
	exit();
}
$configs = include 'config.php';

$conn = new mysqli($configs['servername'], $configs['username'], $configs['password'],$configs['database']);

if ($conn->connect_error) {
	die("Connection failed: ");
} 
$trades=$conn->query("SELECT * FROM trades")->fetch_assoc()["trades"];
if (!$trades) {
	$conn->close();
	if($ten) {
		header("Location: scores10.php?lid=$lid&1");
		exit();
	} else {
		header("Location: scores.php?lid=$lid&2");
		exit();
	}
}
if ($accept) {
	$findoffers="SELECT team_id_1, team_id_2,team_1_speller_1,team_1_speller_2,team_1_speller_3,team_1_speller_4,team_1_speller_5,team_1_speller_6,team_1_speller_7,team_1_speller_8,team_1_speller_9,team_1_speller_10,team_2_speller_1,team_2_speller_2,team_2_speller_3,team_2_speller_4,team_2_speller_5,team_2_speller_6,team_2_speller_7,team_2_speller_8,team_2_speller_9,team_2_speller_10 FROM offers WHERE ten=$tens AND offer_id=$offerid";
	$result=$conn->query($findoffers);
	if ($result->num_rows===0) {
		if($ten) {
			header("Location: scores10.php?lid=$lid&3");
			exit();
		} else {
			header("Location: scores.php?lid=$lid&4");
			exit();
		}
	}
	$row=$result->fetch_assoc();
    $giving=array();
    $taking=array();
    for ($a=1;$a<11;$a++) {
        if ($row["team_1_speller_$a"]) {
        	array_push($giving, $a);
        }
        if ($row["team_2_speller_$a"]) {
        	array_push($taking, $a);
        }
    }
    $giveid=$row["team_id_1"];
    $takeid=$row["team_id_2"];
    $myid=$_SESSION["id"];
    if ($ten) {
    	$mytid=$conn->query("SELECT team_id FROM teams10 WHERE user_id=$myid")->fetch_assoc()["team_id"];
    } else {
    	$mytid=$conn->query("SELECT team_id FROM teams WHERE user_id=$myid")->fetch_assoc()["team_id"];
    }
    
    if ($mytid!==$takeid) {
    	if($ten) {
			header("Location: scores10.php?lid=$lid&$mytid&$takeid");
			exit();
		} else {
			header("Location: scores.php?lid=$lid&6");
			exit();
		}
    }
    $givingids=array();
    $takingids=array();
    if ($ten){
   		foreach($giving as $togive) {
   			$stmt="SELECT speller_id_$togive FROM teams10 WHERE team_id=$giveid";
   			array_push($givingids,$conn->query($stmt)->fetch_assoc()["speller_id_$togive"]);
   			$stmt="DELETE FROM offers WHERE team_1_speller_$togive=True AND team_id_1=$giveid AND ten=True";
   			$conn->query($stmt);
   			$stmt="DELETE FROM offers WHERE team_2_speller_$togive=True AND team_id_2=$giveid AND ten=True";
   			$conn->query($stmt);
   		}
   		foreach($taking as $totake) {
   			$stmt="SELECT speller_id_$totake FROM teams10 WHERE team_id=$takeid";
   			array_push($takingids,$conn->query($stmt)->fetch_assoc()["speller_id_$totake"]);
   			$stmt="DELETE FROM offers WHERE team_1_speller_$totake=True AND team_id_1=$takeid AND ten=True";
   			$conn->query($stmt);
   			$stmt="DELETE FROM offers WHERE team_2_speller_$totake=True AND team_id_2=$takeid AND ten=True";
   			$conn->query($stmt);
   		}
	} else {
		foreach($giving as $togive) {
   			$stmt="SELECT speller_id_$togive FROM teams WHERE team_id=$giveid";
   			array_push($givingids,$conn->query($stmt)->fetch_assoc()["speller_id_$togive"]);
   			$stmt="DELETE FROM offers WHERE team_1_speller_$togive=True AND team_id_1=$giveid AND ten=False";
   			$conn->query($stmt);
   			$stmt="DELETE FROM offers WHERE team_2_speller_$togive=True AND team_id_2=$giveid AND ten=False";
   			$conn->query($stmt);
   		}
   		foreach($taking as $totake) {
   			$stmt="SELECT speller_id_$totake FROM teams WHERE team_id=$takeid";
   			array_push($takingids,$conn->query($stmt)->fetch_assoc()["speller_id_$totake"]);
   			$stmt="DELETE FROM offers WHERE team_1_speller_$totake=True AND team_id_1=$takeid AND ten=False";
   			$conn->query($stmt);
   			$stmt="DELETE FROM offers WHERE team_2_speller_$totake=True AND team_id_2=$takeid AND ten=False";
   			$conn->query($stmt);
   		}
	}
    if (count($giving)>count($taking)) {
        if (4-count($giving)+count($taking)<0) {
        	$conn->close();
        	if($ten) {
				header("Location: scores10.php?lid=$lid&7");
				exit();
			} else {
				header("Location: scores.php?lid=$lid&8");
				exit();
			}
        }
        if ($ten) {
        	$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE team_id=$takeid";
			$row=$conn->query($stmt)->fetch_assoc();
			$takebench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($takebench,$row["speller_id_$i"]);
				}
			}
			$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE team_id=$giveid";
			$row=$conn->query($stmt)->fetch_assoc();
			$givebench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($givebench,$row["speller_id_$i"]);
				}
			}
			if ((count($givebench)-count($giving)+count($taking))>4 || (count($givebench)-count($giving)+count($taking))<0 || (count($takebench)-count($taking)+count($giving))>4 || (count($takebench)-count($taking)+count($giving)<0)) {
				if($ten) {
					header("Location: scores10.php?lid=$lid");
					exit();
				} else {
					header("Location: scores.php?lid=$lid&10");
					exit();
				}
			}
			$i=0;
			foreach ($taking as $toput) {
				$stmt="UPDATE teams10 SET speller_id_$toput=".$givingids[$i]." WHERE team_id=$takeid";
				$conn->query($stmt);
				$i++;
			}
			$toput=count($takebench)+7;
			for ($i=count($takingids);$i<count($givingids);$i++) {
				$stmt="UPDATE teams10 SET speller_id_$toput=".$givingids[$i]." WHERE team_id=$takeid";
				$conn->query($stmt);
				$toput++;
			}
			$i=0;
			$finallength=count($givebench)-count($giving)+count($taking)+6;
			$currentindex=$finallength+1;
			foreach ($giving as $toput) {
				if (isset($takingids[$i])) {
					$stmt="UPDATE teams10 SET speller_id_$toput=".$takingids[$i]." WHERE team_id=$giveid";
					$conn->query($stmt);
				} else {
					if ($toput<=$finallength) {
						$temp=$conn->query("SELECT speller_id_$currentindex FROM teams10 WHERE team_id=$giveid")->fetch_assoc()["speller_id_$currentindex"];
						$conn->query("UPDATE teams10 SET speller_id_$currentindex=NULL WHERE team_id=$giveid");
						$conn->query("UPDATE teams10 SET speller_id_$toput=$temp WHERE team_id=$giveid");
						$conn->query("UPDATE offers SET team_1_speller_$currentindex=0, team_1_speller_$toput=1 WHERE team_id_1=$giveid AND ten=True AND team_1_speller_$currentindex=1");
						$conn->query("UPDATE offers SET team_2_speller_$currentindex=0, team_2_speller_$toput=1 WHERE team_id_2=$giveid AND ten=True AND team_1_speller_$currentindex=1");
						$currentindex++;
					} else {
						$stmt="UPDATE teams10 SET speller_id_$toput=NULL WHERE team_id=$giveid";
						$conn->query($stmt);
					}
				}
				$i++;
			}

        } else {
        	$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE team_id=$takeid";
			$row=$conn->query($stmt)->fetch_assoc();
			$takebench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($takebench,$row["speller_id_$i"]);
				}
			}
			$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE team_id=$giveid";
			$row=$conn->query($stmt)->fetch_assoc();
			$givebench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($givebench,$row["speller_id_$i"]);
				}
			}
			if ((count($givebench)-count($giving)+count($taking))>4 || (count($givebench)-count($giving)+count($taking))<0 || (count($takebench)-count($taking)+count($giving))>4 || (count($takebench)-count($taking)+count($giving)<0)) {
				if($ten) {
					header("Location: scores10.php?lid=$lid&11");
					exit();
				} else {
					header("Location: scores.php?lid=$lid&12");
					exit();
				}
			}
			$i=0;
			foreach ($taking as $toput) {
				$stmt="UPDATE teams SET speller_id_$toput=".$givingids[$i]." WHERE team_id=$takeid";
				$conn->query($stmt);
				$i++;
			}
			$toput=count($takebench)+7;
			for ($i=count($takingids);$i<count($givingids);$i++) {
				$stmt="UPDATE teams SET speller_id_$toput=".$givingids[$i]." WHERE team_id=$takeid";
				$conn->query($stmt);
				$toput++;
			}
			$i=0;
			$finallength=count($givebench)-count($giving)+count($taking)+6;
			$currentindex=$finallength+1;
			foreach ($giving as $toput) {
				if (isset($takingids[$i])) {
					$stmt="UPDATE teams SET speller_id_$toput=".$takingids[$i]." WHERE team_id=$giveid";
					$conn->query($stmt);
				} else {
					if ($toput<=$finallength) {
						$temp=$conn->query("SELECT speller_id_$currentindex FROM teams WHERE team_id=$giveid")->fetch_assoc()["speller_id_$currentindex"];
						$conn->query("UPDATE teams SET speller_id_$currentindex=NULL WHERE team_id=$giveid");
						$conn->query("UPDATE teams SET speller_id_$toput=$temp WHERE team_id=$giveid");
						$conn->query("UPDATE offers SET team_1_speller_$currentindex=0, team_1_speller_$toput=1 WHERE team_id_1=$giveid AND ten=False AND team_1_speller_$currentindex=1");
						$conn->query("UPDATE offers SET team_2_speller_$currentindex=0, team_2_speller_$toput=1 WHERE team_id_2=$giveid AND ten=False AND team_1_speller_$currentindex=1");
						$currentindex++;
					} else {
						$stmt="UPDATE teams10 SET speller_id_$toput=NULL WHERE team_id=$giveid";
						$conn->query($stmt);
					}
				}
				$i++;
			}
        }
    } elseif (count($giving)<count($taking)) {
        if (4+count($giving)-count($taking)<0) {
        	$conn->close();
        	if($ten) {
				header("Location: scores10.php?lid=$lid&13");
				exit();
			} else {
				header("Location: scores.php?lid=$lid&14");
				exit();
			}
        }
        if ($ten) {
        	$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE team_id=$takeid";
			$row=$conn->query($stmt)->fetch_assoc();
			$takebench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($takebench,$row["speller_id_$i"]);
				}
			}
			$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE team_id=$giveid";
			$row=$conn->query($stmt)->fetch_assoc();
			$givebench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($givebench,$row["speller_id_$i"]);
				}
			}
			if ((count($givebench)-count($giving)+count($taking))>4 || (count($givebench)-count($giving)+count($taking))<0 || (count($takebench)-count($taking)+count($giving))>4 || (count($takebench)-count($taking)+count($giving)<0)) {
				if($ten) {
					header("Location: scores10.php?lid=$lid&39");
					exit();
				} else {
					header("Location: scores.php?lid=$lid&38");
					exit();
				}
			}
			$i=0;
			foreach ($giving as $toput) {
				$stmt="UPDATE teams10 SET speller_id_$toput=".$takingids[$i]." WHERE team_id=$giveid";
				$conn->query($stmt);
				$i++;
			}
			$toput=count($givebench)+7;
			for ($i=count($givingids);$i<count($takingids);$i++) {
				$stmt="UPDATE teams10 SET speller_id_$toput=".$takingids[$i]." WHERE team_id=$giveid";
				$conn->query($stmt);
				$toput++;
			}
			$i=0;
			$finallength=count($takebench)-count($taking)+count($giving)+6;
			$currentindex=$finallength+1;
			foreach ($taking as $toput) {
				if (isset($givingids[$i])) {
					$stmt="UPDATE teams10 SET speller_id_$toput=".$givingids[$i]." WHERE team_id=$takeid";
					$conn->query($stmt);
				} else {
					if ($toput<=$finallength) {
						$temp=$conn->query("SELECT speller_id_$currentindex FROM teams10 WHERE team_id=$takeid")->fetch_assoc()["speller_id_$currentindex"];
						$conn->query("UPDATE teams10 SET speller_id_$currentindex=NULL WHERE team_id=$takeid");
						$conn->query("UPDATE teams10 SET speller_id_$toput=$temp WHERE team_id=$takeid");
						$conn->query("UPDATE offers SET team_1_speller_$currentindex=0, team_1_speller_$toput=1 WHERE team_id_1=$takeid AND ten=True AND team_1_speller_$currentindex=1");
						$conn->query("UPDATE offers SET team_2_speller_$currentindex=0, team_2_speller_$toput=1 WHERE team_id_2=$takeid AND ten=True AND team_1_speller_$currentindex=1");
						$currentindex++;
					} else {
						$stmt="UPDATE teams10 SET speller_id_$toput=NULL WHERE team_id=$takeid";
						$conn->query($stmt);
					}
				}
				$i++;
			}

        } else {
        	$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE team_id=$takeid";
			$row=$conn->query($stmt)->fetch_assoc();
			$takebench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($takebench,$row["speller_id_$i"]);
				}
			}
			$stmt="SELECT speller_id_7,speller_id_8,speller_id_9,speller_id_10 FROM teams10 WHERE team_id=$giveid";
			$row=$conn->query($stmt)->fetch_assoc();
			$givebench=array();
			for ($i=7;$i<11;$i++) {
				if (isset($row["speller_id_$i"]) && !empty($row["speller_id_$i"])) {
					array_push($givebench,$row["speller_id_$i"]);
				}
			}
			if ((count($givebench)-count($giving)+count($taking))>4 || (count($givebench)-count($giving)+count($taking))<0 || (count($takebench)-count($taking)+count($giving))>4 || (count($takebench)-count($taking)+count($giving)<0)) {
				if($ten) {
					header("Location: scores10.php?lid=$lid&37");
					exit();
				} else {
					header("Location: scores.php?lid=$lid&36");
					exit();
				}
			}
			$i=0;
			foreach ($giving as $toput) {
				$stmt="UPDATE teams SET speller_id_$toput=".$takingids[$i]." WHERE team_id=$giveid";
				$conn->query($stmt);
				$i++;
			}
			$toput=count($givebench)+7;
			for ($i=count($givingids);$i<count($takinggids);$i++) {
				$stmt="UPDATE teams SET speller_id_$toput=".$takingids[$i]." WHERE team_id=$giveid";
				$conn->query($stmt);
				$toput++;
			}
			$i=0;
			$finallength=count($takebench)-count($taking)+count($giving)+6;
			$currentindex=$finallength+1;
			foreach ($taking as $toput) {
				if (isset($givingids[$i])) {
					$stmt="UPDATE teams SET speller_id_$toput=".$givingids[$i]." WHERE team_id=$giveid";
					$conn->query($stmt);
				} else {
					if ($toput<=$finallength) {
						$temp=$conn->query("SELECT speller_id_$currentindex FROM teams WHERE team_id=$takeid")->fetch_assoc()["speller_id_$currentindex"];
						$conn->query("UPDATE teams SET speller_id_$currentindex=NULL WHERE team_id=$takeid");
						$conn->query("UPDATE teams SET speller_id_$toput=$temp WHERE team_id=$takeid");
						$conn->query("UPDATE offers SET team_1_speller_$currentindex=0, team_1_speller_$toput=1 WHERE team_id_1=$takeid AND ten=False AND team_1_speller_$currentindex=1");
						$conn->query("UPDATE offers SET team_2_speller_$currentindex=0, team_2_speller_$toput=1 WHERE team_id_2=$takeid AND ten=False AND team_1_speller_$currentindex=1");
						$currentindex++;
					} else {
						$stmt="UPDATE teams10 SET speller_id_$toput=NULL WHERE team_id=$takeid";
						$conn->query($stmt);
					}
				}
				$i++;
			}
        }
    } else {
    	if ($ten) {
    		$i=0;
    		foreach ($giving as $toput) {
				$stmt="UPDATE teams10 SET speller_id_$toput=".$takingids[$i]." WHERE team_id=$giveid";
				echo $stmt;
				$conn->query($stmt);
				$i++;
			}
			$i=0;
			foreach ($taking as $toput) {
				$stmt="UPDATE teams10 SET speller_id_$toput=".$givingids[$i]." WHERE team_id=$takeid";
				echo $stmt;
				$conn->query($stmt);
				$i++;
			}
		} else {
			$i=0;
			foreach ($taking as $toput) {
				$stmt="UPDATE teams SET speller_id_$toput=".$givingids[$i]." WHERE team_id=$takeid";
				echo $stmt;
				$conn->query($stmt);
				$i++;
			}
			$i=0;
			foreach ($giving as $toput) {
				$stmt="UPDATE teams SET speller_id_$toput=".$takingids[$i]." WHERE team_id=$giveid";
				echo $stmt;
				$conn->query($stmt);
				$i++;
			}
    	}
	}
} else {
	$conn->query("DELETE FROM offers WHERE offer_id=$offerid");
}
$conn->close();
if($ten) {
	header("Location: scores10.php?lid=$lid&11");
	exit();
} else {
	header("Location: scores.php?lid=$lid&12");
	exit();
}