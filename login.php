<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
<title>Fantasy Spelling</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
</head>

<body>

 <nav class="grey darken-3" role="navigation">
    <div class="nav-wrapper container">
    <a id="logo-container" href="#" class="brand-logo">Fantasy Spelling</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Home</a></li>
        <li><a href="login.php">Log In</a></li>
      </ul>

      <ul id="mobile-demo" class="side-nav">
        <li><a href="#">Home</a></li>
        <li><a href="login.php">Log In</a></li>
      </ul>
    </div>
  </nav>
<form action="db.php" method="post">
 <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" name="first">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      </div>
      <input  class="waves-effect waves-light btn-large" type="submit">
    </form>
  </div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
  $(document).ready(function(){
     $(".button-collapse").sideNav();
});
  </script>

</body>
</html>