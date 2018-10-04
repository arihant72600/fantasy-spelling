<form action="checkchange.php?lid=<?php  echo $lid; if (count($allstuff)===10) {echo "&t=t";} else {echo "&t=f";}?>" method="post">
<br/>
 <h1 class="header center">Modify Lineup</h1>
<br/>
<div class="container">
 <?php
if (empty($allstuff[$mystuff][2][3]) || $allstuff[$mystuff][2][3]===null) {
		$spellerstake=array();
		echo"<h3 class=\"header center\">Add To Bench</h3>";
		echo "<select class=\"js-example-basic-single\" name=\"addspeller\">";
		foreach($allstuff as $cplayer) {
			foreach ($cplayer[1] as $speller) {
				$spellerstake[(int)($speller)]=1;
			}
			foreach ($cplayer[2] as $speller) {
				$spellerstake[(int)($speller)]=1;
			}
		}
		$servername="localhost";
		$username= "id1634423_arihant";
		$password="ajain123";
		$database="id1634423_users";

		$conn = new mysqli($servername, $username, $password,$database);

		if ($conn->connect_error) {
			die("Connection failed: ");
		} 
		for ($l=0; $l<292; $l++) {
			if (!isset($spellerstake[$l])) {
				$row=$conn->query("SELECT name, eliminated FROM spellers WHERE id=$l")->fetch_assoc();
				if (!($row["eliminated"])) {
					echo "<option value=\"$l\">".$row["name"]."</option>";
				}
			}
		}
		$conn->close();
		echo "</select>";
		echo "<br/><br/>";
		echo "<div class=\"center-align\"> <button type=\"submit\" class=\"waves-effect waves-light btn\" name=\"add\">add</button></div>";
		echo"<br/>\n";
}
if (!(empty($allstuff[$mystuff][2][0]) || $allstuff[$mystuff][2][0]===null)) {
		echo"<div class=\"divider\"></div><br/><h3 class=\"header center\">Remove From Bench</h3>";
		$i=7;
		foreach ($allstuff[$mystuff][2] as $spellerid) {

			if (isset($spellerid)) {
				echo "<p><input type=\"checkbox\" id=\"benchr".$i."\" value=\"benchr".$i."\" name=\"benchr[]\"/><label for=\"benchr".$i."\"/>".$benchnames[$mystuff][$i-7]."</label></p>";
			}
			$i=$i+1;
		}
		echo "<div class=\"center-align\"> <button type=\"submit\" class=\"waves-effect waves-light btn\" name=\"remove\">remove</button></div>";
		echo"<br/>\n";
		echo"<div class=\"divider\"></div><h3 class=\"header center\">Subsitute Spellers</h3>";
		echo"<div class=\"row\">";
		echo"<div class=\"col s6\">";
		echo "<h5>Bench</h5>";
		$i=7;
		foreach ($allstuff[$mystuff][2] as $spellerid) {
			if (isset($spellerid)) {
				echo "<p><input name=\"bench\" type=\"radio\" id=\"bench".$i."\" value=\"bench".$i."\"/><label for=\"bench".$i."\"/>".$benchnames[$mystuff][$i-7]."</label></p>";
			}
			$i=$i+1;
		}
		echo "</div>";
		echo "<div class=\"col s6\">";
		echo "<h5>Team</h5>";
		$i=1;
		foreach ($allstuff[$mystuff][1] as $spellerid) {
			if (isset($spellerid)) {
				echo "<p><input name=\"speller\" type=\"radio\" id=\"speller".$i."\" value=\"speller".$i."\"/><label for=\"speller".$i."\"/>".$spellernames[$mystuff][$i-1]."</label></p>";
			}
			$i=$i+1;
		}

		echo"</div> </div>";

		echo "<div class=\"center-align\"> <button type=\"submit\" class=\"waves-effect waves-light btn\" name=\"subsitute\">subsitute</button></div>";
		echo"<br/>\n";
		
}
 ?>

 </div>
 <div class="container">
 <br/>
 <br/>
 <h1 class="header center">Trades</h1>
 <div class="center-align"><h3 class="header center">Propose Trade</h3></div>
 <div class="row">
 <div>
 <ul class="tabs">

<?php
$i =0;
foreach ($allstuff as $cuser) {
	
	if (($_SESSION["fName"]." ".$_SESSION["lName"])===$names[$i]) {
	} else {
		echo "<li class=\"tab";
		echo"\"";
		echo "><a href=\"#trade".$i."\">".$names[$i]."</a></li>\n";
	}
	
	$i=$i+1;
}
?>
</ul>
<?php

$i =0;
foreach ($allstuff as $cuser) {
if (($_SESSION["id"])===(int)($cuser[0])) {
	$i=$i+1;
	continue;
}
echo "<div id=\"trade".$i."\" class=\"col s12\">";
echo "<div class=\"row\">";
echo "<div class=\"col s6\">";
$j=0;
foreach ($allstuff[$mystuff][1] as $spellerid) {

			if (isset($spellerid)) {
				echo "<p><input type=\"checkbox\" name=\"mytrade".$i."[]\" id=\"mytrade$i".($j)."\" value=\"mytrade$i".($j)."\"/><label for=\"mytrade$i".($j)."\"/>".$spellernames[$mystuff][$j]."</label></p>";
			}
			$j=$j+1;
		}
		$j=6;
foreach ($allstuff[$mystuff][2] as $benchid) {
			if (isset($benchid)) {
				echo "<p><input type=\"checkbox\" name=\"mytrade".$i."[]\" id=\"mytrade$i".($j)."\" value=\"mytrade$i".($j)."\"/><label for=\"mytrade$i".($j)."\"/>".$benchnames[$mystuff][$j-6]."</label></p>";
			}
			$j=$j+1;
		}
echo"</div>\n";
echo "<div class=\"col s6\">";
$j=0;
foreach ($cuser[1] as $spellerid) {

			if (isset($spellerid)) {
				echo "<p><input type=\"checkbox\" name=\"otrade".$i."[]\" id=\"otrade$i".($j)."\" value=\"otrade$i".($j)."\"\><label for=\"otrade$i".($j)."\"/>".$spellernames[$i][$j]."</label></p>";
			}
			$j=$j+1;
		}
		$j=6;
foreach ($cuser[2] as $benchid) {
			if (isset($benchid)) {
				echo "<p><input type=\"checkbox\" name=\"otrade".$i."[]\" id=\"otrade$i".($j)."\" value=\"otrade$i".($j)."\"/><label for=\"otrade$i".($j)."\"/>".$benchnames[$i][$j-6]."</label></p>";
			}
			$j=$j+1;
		}
echo"</div>\n";
echo"</div>\n";
echo "<input type=\"hidden\" name=\"oid".$i."\" value=\"".$cuser[0]."\">";
echo "<div class=\"center-align\"> <button type=\"submit\" class=\"waves-effect waves-light btn\" name=\"tradewith".$i."\">send</button></div>";
echo"</div>\n";
$i=$i+1;
}
?>
</div>
</div>
</div>
</form>
<?php
$servername="localhost";
$username= "id1634423_arihant";
$password="ajain123";
$database="id1634423_users";

$conn = new mysqli($servername, $username, $password,$database);

if ($conn->connect_error) {
	die("Connection failed: ");
}
$mytid=$allstuff[$mystuff][4];
$ten=(count($allstuff)===10);
if (!($ten)) {
	$ten="False";
} else {
	$ten="True";
}
$findoffers="SELECT offer_id,team_id_1,team_1_speller_1,team_1_speller_2,team_1_speller_3,team_1_speller_4,team_1_speller_5,team_1_speller_6,team_1_speller_7,team_1_speller_8,team_1_speller_9,team_1_speller_10,team_2_speller_1,team_2_speller_2,team_2_speller_3,team_2_speller_4,team_2_speller_5,team_2_speller_6,team_2_speller_7,team_2_speller_8,team_2_speller_9,team_2_speller_10 FROM offers WHERE ten=$ten AND team_id_2=$mytid";

$result=$conn->query($findoffers);
if ($result->num_rows>0) {
	echo "<div class=\"container\"";
	echo "<br/><div class=\"center-align\"><h3 class=\"header center\">Accept Trade</h3></div><br/>";
	
	while($row = $result->fetch_assoc()) {
		$offerid=$row["offer_id"];
		echo "<div class=\"row\">";
        $giving=array();
        $taking=array();
        for ($a=1;$a<11;$a++) {
        	if ($row["team_1_speller_$a"]) {
        		array_push($taking, $a-1);
        	}
        	if ($row["team_2_speller_$a"]) {
        		array_push($giving, $a-1);
        	}
        }
        for ($b=0;$b<10;$b++) {
        	if ($allstuff[$b][4]===$row["team_id_1"]) {
        		$ostuff=$b;
        	}
        }
        echo "<div class=\"col s12 m6\">";
        echo "<h5>You Get</h5>";
        echo "<ul class=\"collection\">";
        foreach ($taking as $totake) {
        	if ($totake>5){
        		echo "<li class=\"collection-item\">".$benchnames[$ostuff][$totake-6]."</li>";
        	} else {
        		echo "<li class=\"collection-item\">".$spellernames[$ostuff][$totake]."</li>";
        	}
        }
        echo "</ul>";
        echo "</div>";
        echo "<div class=\"col s12 m6\">";
        echo "<h5>".$names[$ostuff]." Gets</h5>";
        echo "<ul class=\"collection\">";
        foreach ($giving as $togive) {
        	if ($togive>5){
        		echo "<li class=\"collection-item\">".$benchnames[$mystuff][$togive-6]."</li>";
        	} else {
        		echo "<li class=\"collection-item\">".$spellernames[$mystuff][$togive]."</li>";
        	}
        }
        echo "</ul>";
        echo "</div>";
        echo"</div>";
        if (count($giving)>count($taking)) {
        	if (4-count($giving)+count($taking)<0 || isset($allstuff[$ostuff][2][4-count($giving)+count($taking)])) {
        		echo "<div class=\"center-align\"><a class=\"waves-effect waves-light btn red\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=f&ten=$ten\">decline</a><br/><p class=\"text-red\">There is not enough space on ".$names[$ostuff]."'s bench to accept this offer.</p>";
        	}  else if (!(isset($allstuff[$mystuff][2][count($giving)-count($taking)-1]))) {
        		echo "<div class=\"center-align\"><a class=\"waves-effect waves-light btn red\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=f&ten=$ten\">decline</a><br/><p class=\"text-red\">You need to add more spellers to accept this offer</p>";
        	} else {
        	echo "<div class=\"center-align\"><a class=\"waves-effect waves-light btn red\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=f&ten=$ten\">decline</a>  <a class=\"waves-effect waves-light btn\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=t&ten=$ten\">accept</a></div><br/>";
    		}
        } else if (count($giving)<count($taking)) {
        	if (4+count($giving)-count($taking)<0 || isset($allstuff[$mystuff][2][4+count($giving)-count($taking)])) {
        		echo "<div class=\"center-align\"><a class=\"waves-effect waves-light btn red\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=f&ten=$ten\">decline</a><br/><p class=\"text-red\">There is not enough space on your bench to accept this offer.</p>";
        	} else if (!(isset($allstuff[$ostuff][2][count($taking)-count($giving)-1]))) {
        		echo "<div class=\"center-align\"><a class=\"waves-effect waves-light btn red\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=f&ten=$ten\">decline</a><br/><p class=\"text-red\"".$names[$ostuff]." needs to add more spellers to accept this offer</p>";
        	} else {
        	echo "<div class=\"center-align\"><a class=\"waves-effect waves-light btn red\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=f&ten=$ten\">decline</a>  <a class=\"waves-effect waves-light btn\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=t&ten=$ten\">accept</a></div><br/>";
    		}
        } else {
        	echo "<div class=\"center-align\"><a class=\"waves-effect waves-light btn red\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=f&ten=$ten\">decline</a>  <a class=\"waves-effect waves-light btn\" href=\"acceptoffer.php?lid=$lid&offerid=$offerid&accept=t&ten=$ten\">accept</a></div><br/>";
    	}
        echo "<div class=\"divider\"></div><br/>";
    }
	
	echo"</div>";

}
?>