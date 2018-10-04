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
 <style>
  .modal {
  	    width: 80%;
  }
.modal {
    max-width: 300px;
    max-height: 420px;
    overflow: visible;
}
html {
height:100%;
	}
@media only screen and (min-height: 700px) {
.valign-wrapper{
		height:100%;
	}
}
 </style>
</head>

<body class="grey darken-4" style="height:100%">

 <nav class="grey darken-3" role="navigation">
    <div class="nav-wrapper container">
    <a id="logo-container" href="#" class="brand-logo"><span style="font-family:Calibri;">Fantasy Spelling
  			</span></a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="index.php">Home</a></li>
        <li><a href="#modal">Log In</a></li>
        <li><a href="signup.php">Sign Up</a></li>
      </ul>

      <ul id="mobile-demo" class="side-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="#modal">Log In</a></li>
        <li><a href="signup.php">Sign Up</a></li>
      </ul>
    </div>
  </nav>

<div class="valign-wrapper" style="width:100%;">
    <div class="" style="width:100%;">
   <div class="row">
    <div class="col s12 m4 push-m4">
    <div class="card white hoverable z-depth-4">
      <form class="login-form"  action="db.php" method="post" id="k">
        <div class="row">
          <div class="input-field col s12 center">
            <h4>Register</h4>
            <p class="center">Join a League Today!</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s6">
            <label for="FirstName" class="center-align">First Name</label>
            <input id="FirstName" type="text" name="FirstName" data-error=".errorTxt1"
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
  				if (isset($_GET['first']) && !empty($_GET["first"])) {
  					$first=$_GET['first'];
  					echo "value=$first";
				}
			}
  	?>>
            <div class="errorTxt1"></div>
          </div>
          <div class="input-field col s6">
          <label for="LastName" class="center-align">Last Name</label>
            <input id="LastName" type="text" name="LastName" data-error=".errorTxt2" <?php 
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
  				if (isset($_GET['last']) && !empty($_GET["last"])) {
  					$last=$_GET['last'];
  					echo "value=$last";
				}
			}
  	?>>
            <div class="errorTxt2"></div>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <input id="uname" type="text" name="uname" data-error=".errorTxt3">
            <label for="uname" class="center-align">Username</label>
            <div class="errorTxt3"><?php 
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
  				if (isset($_GET['u']) && !empty($_GET["u"])) {
  					echo "Username was taken";
				}
			}
  	?></div>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <input id="password" type="password" name="password" data-error=".errorTxt4">
            <label for="password">Password</label>
            <div class="errorTxt4"></div>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <input id="passwordagain" type="password" name="passwordagain" data-error=".errorTxt5">
            <label for="passwordagain">Password again</label>
            <div class="errorTxt5"></div>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" class="btn waves-effect waves-light col s12">Register Now</button>
          </div>
          
        </div>
      </form>
      <br/>
      </div>
    </div>
  </div>
 </div>
</div>
  <!-- Modal Structure -->
  <div id="modal" class="modal">
  <form action="dblogin.php" method="post">
    <div class="modal-content">
    <div class="row">
    <div class="col s12">
      <h3 style="font-size:1.4rem;font-weight:500;line-height:normal;margin-top: 0;font-weight: 500;margin-bottom: 1rem;">Login</h3>
      </div> 
      <div class="col s12">
      <p><?php
      if ($_SERVER["REQUEST_METHOD"] === "GET") {
  				if (isset($_GET['uop']) && !empty($_GET["uop"])) {
  					echo "Username or Password was incorrect";
				}
			}
  	?></p>
  	</div>
     <div class="input-field col s12">
     <i class="material-icons prefix">account_circle</i>
     <input id="username" name="username" type="text">
     <label for="username">Username</label>
     </div>
     <div class="input-field col s12">
     <i class="material-icons prefix">lock_outline</i>
     <input id="passwordd" type="password" name="password">
     <label for="passwordd">Password</label>
     </div>
     <div class="col s12">
     <p>Don't have an account? Click <a href="signup.php">here</a>.</p>
     </div>
    </div>

    <div class="modal-footer">
    <button type="submit" class="waves-effect btn-flat main-blue" style="float: right; margin: 6px 0;color: #04afef;">LOGIN</button>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">CLOSE</a>
    </div>
    </div>
    </form>
  </div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
     <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> 
      <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/additional-methods.js"></script>
      <script>
  $(document).ready(function(){
     $(".button-collapse").sideNav();
      $('.modal').modal({
      dismissible: true, 
      opacity: 0.8, 
      inDuration: 300, 
      outDuration: 200, 
      ready: function(modal, trigger) { 
      },
      complete: function() { } 
    }

  );
});
  $("#k").validate({
        rules: {
            FirstName: {
                required: true,
                lettersonly: true
            },
            LastName: {
                required: true,
                lettersonly: true
            },
            uname: {
                required: true,
                alphanumeric : true
            },
            password: {
                required: true,
                minlength: 8
            },
            passwordagain: {
            	required: true,
				minlength: 8,
				equalTo: "#password"
            },


            

           
        },
        //For custom messages
        messages: {
        	passwordagain: {
        		equalTo:"Enter the same password."
        	},
        	 uname: {
                 alphanumeric: "Only alphanumeric characters allowed"
            },
            FirstName: {
                 lettersonly: "Only letters allowed"
            }, 
            LastName: {
                 lettersonly: "Only letters allowed"
            },
        },

        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
  </script>

</body>
</html>