<?php
session_start();
session_unset(); 
session_destroy(); 
setcookie("id", "", time() - 3600);
setcookie("fName", "", time() - 3600);
setcookie("lName", "", time() - 3600);
setcookie("uName", "", time() - 3600);
header("Location: index.php");
exit();
?>