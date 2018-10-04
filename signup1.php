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

</style>

</head>

<body  >

 <div class="valign-wrapper" id="login-page">
    <div class="container">
        <div class="center-align">
            <div class="row">
                <div class="col s0 m4 l4" />
                <div class="col s12 m4 l4">
                    <div class="card">
                        <div class="card-content">
                            <img class="responsive-img"
                                src="http://idsoft.com.ar/javax.faces.resource/div.png.xhtml?ln=img"
                                style="max-width: 64px;" />
                            <div class="left-align">
                                <h:form id="form-login">
                                    <p:growl autoUpdate="true" />
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <h:inputText id="username" value="#{login.username}"
                                                required="true" requiredMessage="User required" />
                                            <h:outputLabel for="username" value="User" />
                                        </div>
                                        <div class="col s12 input-field">
                                            <h:inputSecret id="password" required="true"
                                                value="#{login.password}"
                                                requiredMessage="Password required!" />
                                            <h:outputLabel for="password" value="Password" />
                                        </div>
                                        <div class="col s12 input-field">
                                            <h:commandLink value="Go!" styleClass="btn btn-large"
                                                actionListener="#{login.access()}" />
                                        </div>
                                    </div>
                                </h:form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s0 m4 l4" />
            </div>
        </div>
    </div>
</div>
<h:outputScript name="js/jquery.js" />
<h:outputScript name="js/materialize.js" />
<script>
        $(document).on("ready",function(){
            $('#login-page').css({'height': window.innerHeight + 'px'});
        });
    </script>
</body>
</html>