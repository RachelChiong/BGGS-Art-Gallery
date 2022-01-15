<?php
session_start();
if ($_SESSION['userType'] != 'ADMIN') {
header('Location: ../index.php?NotSignedIn');
exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="styles/adminStyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/bggs_icon.png">
    <!-- Link bootstrap styles library -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!-- Link existing style sheets -->
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/Rachel.css">
    <link rel="stylesheet" href="../styles/Josie.css">
    <!-- Link new admin style sheet -->
    <link rel="stylesheet" href="../styles/adminstyles.css">
    <!-- Link jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Link bootstrap javascript library -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <title><?php echo $_GET['table'] 
    
    ?></title>
    <!-- Link add tooltip animation script -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    
    <style>
    .ret_img {
        width: 50px;
        height: auto;
    }
    footer {
  left: 0;
  bottom: 0;
  height: 10%;

  background-color: rgb(244,244,244); width: 100%; height: 10%;
    }

/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 1;
	background: url('img/preloader.gif') center no-repeat #fff;
}
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script>
    //paste this code under the head tag or in a separate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>
    </style>
</head>
<body>
<div class="se-pre-con"></div>
<header style="background-color: rgb(244,244,244); width: 100%">

<nav class="nav-header-main" id="nav_cont">
            <a class="header-logo" href='../index.php'>
            <img src= "../img/BGGS-Logo-Reflex-Blue-RGB.png" alt="BGGS logo">
            </a>
            <ul class="nav_links">
            

           <li class="header_li" style="margin-left: 40px"><a style="text-decoration: none; color: #00B2A9" href="../dashboard.php?table=Artworks&resetsearch=">Athena Dashboard</a></li>
                <li class="header_li"><a style="text-decoration: none;" href="user_update.php">User Profile</a></li>
                </ul>
                
            
                </nav>
                <div class="header-login" style='float: right;'><?php 
            echo '<form action="../includes/logout.inc.php" method="post">
            <button type="submit" name="logout-submit" style="margin-top: 10px; margin-left: 0;">Logout</button>
            </form>'; ?> </div>

</header>