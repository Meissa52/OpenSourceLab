<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
      <title></title>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
   </head>
   <body>
      <nav class="grey darken-4" role="navigation">
         <div class="nav-wrapper container">
         <a href="#" class="brand-logo center"><img id="nav-logo" src="images/nav-logo.png"/></a>
            <ul id="main-nav" class="hide-on-med-and-down">
            <li class="right"><a  href="SignUp.php" style="<?php if(isset($_SESSION['email'])) echo 'display:none;';?>">Create Account</a></li>
            <li class="white-text right"><a  href="Login.php" style="<?php if(isset($_SESSION['email'])) echo 'display:none;';?>">Login</a></li>
           
               <?php 
                  if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                       echo("<li class='right'><a id='logout' href='models/logout.php'>Logout</a></li>");
                       //echo("<li class='right'><a id='Profile' href='#'>Profile</a></li>");
                  }
                  ?>
                   <li class="right" style="font-weight:bold;"><a href="index.php">Home</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="black-text material-icons white">menu</i></a>
         </div>
      </nav>
      <ul class="side-nav white" id="nav-mobile">
         <li><a href="index.php">Home</a></li>
         <li><a  href="Login.php" style="<?php if(isset($_SESSION['email'])) echo 'display:none;';?>">Login</a></li>
         <li><a  href="SignUp.php" style="<?php if(isset($_SESSION['email'])) echo 'display:none;';?>">Register</a></li>
         <?php 
                  if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                       echo("<li><a id='logout' class='black-text' href='models/logout.php'>Logout</a></li>");
                  }
                  ?>
      </ul>


      