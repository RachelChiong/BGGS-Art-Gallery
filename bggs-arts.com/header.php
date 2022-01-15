<?php 
//make sure session has started on all pages//
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name=apple-mobile-web-app-capable content=yes>
<meta name=apple-mobile-web-app-status-bar-style content=black>
<link rel="apple-touch-icon" sizes="128x128" href="img/app-icon.png">

<style>
#page {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  }


</style><script>
var page = document.getElementById('page'),
    ua = navigator.userAgent,
    iphone = ~ua.indexOf('iPhone') || ~ua.indexOf('iPod'),
    ipad = ~ua.indexOf('iPad'),
    ios = iphone || ipad,
    // Detect if this is running as a fullscreen app from the homescreen
    fullscreen = window.navigator.standalone,
    android = ~ua.indexOf('Android'),
    lastWidth = 0;

if (android) {
  // Android's browser adds the scroll position to the innerHeight, just to
  // make this really fucking difficult. Thus, once we are scrolled, the
  // page height value needs to be corrected in case the page is loaded
  // when already scrolled down. The pageYOffset is of no use, since it always
  // returns 0 while the address bar is displayed.
  window.onscroll = function() {
    page.style.height = window.innerHeight + 'px'
  } 
}
var setupScroll = window.onload = function() {
  // Start out by adding the height of the location bar to the width, so that
  // we can scroll past it
  if (ios) {
    // iOS reliably returns the innerWindow size for documentElement.clientHeight
    // but window.innerHeight is sometimes the wrong value after rotating
    // the orientation
    var height = document.documentElement.clientHeight;
    // Only add extra padding to the height on iphone / ipod, since the ipad
    // browser doesn't scroll off the location bar.
    if (iphone && !fullscreen) height += 60;
    page.style.height = height + 'px';
  } else if (android) {
    // The stock Android browser has a location bar height of 56 pixels, but
    // this very likely could be broken in other Android browsers.
    page.style.height = (window.innerHeight + 56) + 'px'
  }
  // Scroll after a timeout, since iOS will scroll to the top of the page
  // after it fires the onload event
  setTimeout(scrollTo, 0, 0, 1);
};
(window.onresize = function() {
  var pageWidth = page.offsetWidth;
  // Android doesn't support orientation change, so check for when the width
  // changes to figure out when the orientation changes
  if (lastWidth == pageWidth) return;
  lastWidth = pageWidth;
  setupScroll();
})();
</script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
    <?php echo($pagetitle) ?>
    </title>
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" type="text/css" href="styles/Rachel.css">
    <link rel="stylesheet" type="text/css" href="styles/Josie.css">
    <link rel="stylesheet" href="styles/adminstyles.css">
    <link rel="icon" href="img/bggs_icon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        #userType {
            font-family: 'Times New Roman';
            margin-right: -100px;
        }
        #hamburger {
            display: none;
            font-size: 50px;
            color: rgb(0,20,137);
            float: right;
        }

        #gal_search_link {
            display: none;
        }
        #respon_links {
            display: none;
        }
@media only screen and (min-width: 1101px){
    .overlay {
            display: none;
        }
}
       
        @media only screen and (max-width: 1100px) {
            .nav_links {
                display: none;
            }
           
            .header-login {
                display: none;
            }

            #gal_search_link {
                display: block;
                font-family: 'Times New Roman';
                color: rgb(0,37,84);
                font-size: 20px;
                margin-top: 20px;
            }
            #hamburger {
                display: block;
            }

            .nav_links {
                background-color: rgb(0,37,84,0.8);
                height: 100%;
                color: white;
                width: 100%;
            }

            #respon_links {
                display: block;
                width: 100%;
            }

            .header_li:after {
    border-top: 2px solid #001489;
    content: "";
    position: absolute;
      right: 100%;
      bottom: 0;
      left: 0;
    transition: right .4s cubic-bezier(0,.5,0,1);
  }

  .overlay {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background: rgba(255,255,255, 0.95);
  overflow-x: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 25%;
  width: 100%;
  text-align: center;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 28px;
  color: rgba(0,27,137);
  display: block;
  transition: 0.3s;
  text-align: center;
  
}

.overlay li {
   max-width: 230px;
   list-style: none;
   margin-right: 40%;
   margin-left: 40%;
   padding: 2px;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
}

.respon_login {
    display: block;
    margin-right: 40%;
   margin-left: 40%;
}
.respon_login input {
    font-size: 20px;
    border: 0;
    border-bottom: 2px solid rgb(0,24,137);
    background: none;
}
.overlay form button {
    height: 40px;
    width: 106px;
    padding: 0 10px;
    border: none;
    border-radius: 4px;
    border: 2px solid #001489;
    background-color: #FFFFFF;
    margin-left: 8px;
    font-family: baskerville-urw,Georgia,"Times New Roman",Times,serif;
    font-size: 13px;
    color:  #56575c;
    text-transform: uppercase;
    text-align: center;
  }

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

</head>

<body>
<div class="se-pre-con">
</div>



    <header style="position: fixed; z-index: 2; width: 100%;">
        <nav class="nav-header-main" id="nav_cont">
            <a class="header-logo" href='index.php'>
            <img src= "img/BGGS-Logo-Reflex-Blue-RGB.png" alt="BGGS logo" style="max-width: 100px">
            </a>
            <ul class="nav_links">
            <li class="header_li"><a href="index.php">Home</a></li>
                <li class="header_li"><a href="gal_search.php">Gallery Search</a></li>
                <li class="header_li"><a href="walkthrough.php">360&deg; Gallery</a></li>
                <li class="header_li"><a href="loc_gal.php">Locations</a></li>
                <?php if ($_SESSION['userType'] == NULL) {
                echo '<li class="header_li"><a style= "color:#00B2A9;" href="signup.php">Sign Up</a></li>'; }?>
                <?php if ($_SESSION['userType'] == 'ADMIN') {
                    echo '<li class="header_li"><a style= "color:#00B2A9;" href="dashboard.php?table=Artworks&resetsearch=">ATHENA Dashboard</a></li>';
                } else if ($_SESSION['userType'] == 'FACILITIES') {
                    echo '<li class="header_li"><a style= "color:#00B2A9;" href="user_update_main.php">User Profile</a></li>';
                }; ?>
                
                </ul>
            <li class="header_li" id='gal_search_link'><a href="gal_search.php" style="color: rgb(0,24,137);" >GALLERY SEARCH</a></li>
        </nav>
        
        <div class="header-login">
            <?php
            
            if (isset($_SESSION['idUsers'])) {
                /// Declare a variable to store the 'user type'.
                $uType= $_SESSION['userType'];
                /// Check if the user is a student
               
                    echo '<p id="userType">Logged in as: '.$uType.'</p>'; 
               
                
                
                echo '<form action="includes/logout.inc.php" method="post" style="margin-right: 15px">
                <button type="submit" name="logout-submit" style="margin-top: 30px; margin-left: 0;" id="logout_btn">Logout</button>
                </form>';
            } /// Display login form
                else {
                    echo '<form action="includes/login.inc.php" method="post" style="margin-right: 15px">
                    <input type="text" alt="username or email input field" name="mailuid" placeholder="Username/email">
                    <input type="password" alt="password input field" name="pwd" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                </form>';
                }
                ?>
        </div>
        <div id="hamburger" onclick="openNav()">&#9776;</div>
        <style>
        .newStyle {
          z-index: 10;
          width: 100%;

        }
        </style>

    <div id="myNav" class="overlay">
    <ul>
    <li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></li><br style="line-height:100px;">
    
                <li class="header_li"><a href="index.php">Home</a></li>
                <li class="header_li" ><a href="gal_search.php">Gallery Search</a></li>
                <li class="header_li"><a href="walkthrough.php">360&deg; Gallery</a></li>
                <li class="header_li"><a href="loc_gal.php">Locations</a></li>
                <?php if ($_SESSION['userType'] == NULL) {
                echo '<li class="header_li"><a style= "color:#00B2A9;" href="signup.php">Sign Up</a></li>'; }?>
                <?php if ($_SESSION['userType'] == 'ADMIN') {
                    echo '<li class="header_li"><a style= "color:#00B2A9;" href="dashboard.php?table=Artworks">Admin Dashboard</a></li>';
                } else if ($_SESSION['userType'] == 'FACILITIES') {
                    echo '<li class="header_li"><a style= "color:#00B2A9;" href="user_update_main.php">User Profile</a></li>';
                }; ?>
                <div class="respon_login">
            <?php
            
                if (isset($_SESSION['idUsers'])) {
                    /// Declare a variable to store the 'user type'.
                    $uType= $_SESSION['userType'];
                    /// Check if the user is a student
                   
                        echo '<p id="userType">Logged in as:'.$uType.'</p>'; 
                   
                    
                    
                    echo '<form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit" style="margin-top: 30px; margin-left: 0;" id="logout_btn">Logout</button>
                    </form>';
                }
                else {
                    echo '<form action="includes/login.inc.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/email" style="margin-left: -10%;"><br><br>
                    <input type="password" name="pwd" placeholder="Password" style="margin-left: -10%;"><br><br>
                    <button type="submit" name="login-submit">Login</button>
                </form>';
                }
                ?>
        
    </div>
    </ul>
   
    </div>

<script>
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
</script>
       
    </header>
