<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="styles/adminStyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/bggs_icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/Rachel.css">
    <link rel="stylesheet" href="styles/Josie.css">
    <link rel="stylesheet" href="styles/adminStyles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <title>Dashboard: <?php echo $_GET['table'] ?></title>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    
    <style>
        .ret_img {
  width: auto;
  height: 50px;
}

.topnavGrid {
  display: grid;
grid-template-columns: 10% 75% 5% 10%;
padding-bottom: 1%;
}

.topnavGridEl {
grid-row-start: 1;
grid-row-end: 3;
}

.searchBtn {
  background-color: rgb(255,197,110);
  border: none;
  padding: 5px 10px 5px 10px;
  border-radius: 10px;
  height: 40px;
  margin-left: 5px;
}

.searchBtn:hover {
    background-color: rgb(240,182,95);

}

.resetBtn {
  background-color: rgb(255,197,110);
  border: none;
  padding: 5px 10px 5px 10px;
  border-radius: 10px;
  height: 40px;
  margin-left: 5px;
}

.resetBtn:hover {
    background-color: rgb(240,182,95);

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
	z-index: 100;
	background: url('img/preloader.gif') center no-repeat rgb(255,255,255, 0.7);
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
<?php
session_start();
if ($_SESSION['userType'] != 'ADMIN') {
  header('Location: index.php?error=NotSignedIn');
  exit();
} ?>
<?php 
// Reset the search query so that the default artworks table is displayed (with all data)
if(isset($_GET['resetsearch'])) {
    // Clear all variables containing the search
    $_SESSION['aInput'] = $_GET['aInput'] = $aInput = "";
    $_GET['table'] = 'Artworks';
}

// check if user has submitted a new search
if (isset($_GET['aInput'])) {
    // include connection via traditional mysqli and meekroDB
    include 'includes/dbh.inc.php';
    include 'connect.php';

    // Convert special characters in search query to normal characters to prevent SQL injection.
    $searchQuery = mysqli_real_escape_string($conn, $_GET['aInput']);

    // Create the temporary aggregate table for the search to be executed in 
    $makeTemp = "CREATE TEMPORARY TABLE temptable(
        `temp_id` INT PRIMARY KEY AUTO_INCREMENT,
        `ID` INT(11),
        `Title` varchar(255),
        `Artist_Name` varchar(255),
        `Media` varchar(255),
        `Location` varchar(255),
        `Image` longblob
        )";
    // Connect to database and execute query
    mysqli_query($conn, $makeTemp) or trigger_error(mysqli_error($conn));
    
    // Insert aggregate table data from other tables into the temporary table
    $insertTemp = "INSERT INTO temptable(`ID`, `Title`, `Artist_Name`, `Media`, `Location`, `Image`)
        SELECT a.a_id, a.a_title, CONCAT(r.a_fname,' ', r.a_lname), m.m_name, l.room, a.img 
        FROM artworks AS a, artists AS r, locations AS l, media AS m
        WHERE a.artist_id = r.artist_id AND a.l_id = l.l_id AND a.m_id = m.m_id;";

    // Connect to the database and execute query
    mysqli_query($conn, $insertTemp) or trigger_error(mysqli_error($conn));
        
    $_SESSION['aInput'] = $_GET['aInput'];

}




?>
<nav class="nav-header-main" id="nav_cont">
            <a class="header-logo" href='index.php'>
            <img src= "img/BGGS-Logo-Reflex-Blue-RGB.png" alt="BGGS logo">
            </a>
            <ul class="nav_links">
                
           <li class="header_li" style="margin-left: 40px"><a style="text-decoration: none; color: #00B2A9" href="#">ATHENA Dashboard</a></li>
                <li class="header_li"><a style="text-decoration: none;" href="crud/user_update.php">User Profile</a></li>
                </ul>
                
                </nav>
                <div class="header-login" style="float: right;">
            <?php 
            echo '<form action="includes/logout.inc.php" method="post">
            <button aria-label="Log out button" type="submit" name="logout-submit" style="margin-top: 10px; margin-left: -10%;">Log out</button>
            </form>'; ?> </div>

</header>
 <!--- Organising the components into a grid makes the webpage more engaging as there is a balance. A separate div including the two 'grid items' is needed  -->
 <?php
    if (($_GET['delete'] == 'TRUE') OR (isset($_GET['changed']))) {
        echo '
        <script>
    $(document).ready(function(){
        $("#myModal").modal("show");
    });
</script>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 50px;">&times;</button>';
                if ($_GET['delete'] == 'TRUE') {
                   echo '<h4 class="modal-title">Record successfully deleted!</h4>';
                } else {
                    echo '<h4 class="modal-title">'.$_GET['changed'].' users changed! </h4>';
                }
                
         echo '   </div>
        </div>
    </div>
</div>
       ';
    }
 ?>
 <div class="dash_layout">
   <?php include 'navbar.php';
     ?>
   
    <!-- Create the search table -->
    <div class="searchTable">
    <div class="topbar">
    
    </div>
        <?php 
        require_once 'connect.php'; 
        echo '<h2>'.$_GET['table'].'</h2>'; 
        echo '<div class="topnavGrid"><div class="topnavGridEl"><p class="btn btn-dark" style="background-color: rgb(0,20,137); font-size: 18px"><a href="crud/create.php?table='.$_GET['table'].'" style="color: white; text-decoration: none;">Add New</a></p></li></div>';
        echo '
        <div class="topnavGridEl">';
        if($_GET['table']=='Artworks'){ ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
            <div><input aria-label="Search input text box" type="text" width="70%" class="search_input" id="aInput" name="aInput" placeholder="General Search..."
            onfocus="this.placeholder = """
            onblur="this.placeholder = """ autofocus /><button aria-label="Submit search button" data-toggle="tooltip" Title="Search" type="submit" class="searchBtn"><span alt="search" class="glyphicon glyphicon-search"></span></button><button  aria-label="Reset search button" data-toggle="tooltip" Title="Reset Search" class="resetBtn" type="submit" name="resetsearch"><span alt="reset" class="glyphicon glyphicon-repeat"></span></button>
            <?php
            echo '<input type="text" name="table" value="Artworks" hidden></div></div>';
        
        echo    '</form>';
        
        }else {
        echo '<!-- Search input adapted from Sergey Ioffe from Codepen.io Source: https://codepen.io/sergey_ioffe/pen/XoXpjE -->
        <input type="text" maxwidth="70" class="search_input" id="myInput" placeholder="General search..." 
        onfocus="this.placeholder = """
        onblur="this.placeholder = "Search"" autofocus />
        </div>';}
        if($_GET['table'] == 'Users') {
            echo '<form method="post" action="includes/users.inc.php">';
echo '<div class="topnavGridEl"><button style="border: none; float: right; margin-right: -200%" type="submit" name="type-submit"><a class="btn btn-warning" style="font-size: 20px; ">Update users</a></button>
<input name="table" value="Users" hidden>
</div>';
        } else {
            echo '<div class="topnavGridEl" style="margin-top: 17%">Results</div><div class="topnavGridEl"><select class="form-control form-control-sm">
        <option></option>
        <option>5</option>
        <option>10</option>
      </select></div>';
        }
        
        echo '</div>';
      
        
        include 'tables/'.$_GET['table'].'.php';
        

        ?>
         
         
<div class="pagination p1" style="margin-left: 30%; margin-right: 30%; margin-top: -20px ">
<ul>
<a href="?table=<?php echo $_GET['table'] ?><?php echo '&aInput='.$aInput ?>&pageno=1<?php echo '&selOrder='.$selOrder ?>"><li>First</li></a>

<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?table=".$_GET['table']."&selOrder=".$selOrder."&pageno=".($pageno - 1); } ?><?php echo '&aInput='.$aInput ?>"> <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
       <
    </li></a>

<?php 

for ($i=0; $i < $total_pages; $i++) {
    if($pageno == ($i+1)) {
        $active = 'is-active';
    } else {
        $active = '';
    };
    echo '<a href="?table='.$_GET['table'].'&selOrder='.$selOrder.'&aInput='.$aInput.'&pageno='.($i + 1).'" name="pagniation" value="'.($i +1).'" class="'.$active.'"><li>'.($i + 1).'</li></a>';
}
 ?>
   <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?table=".$_GET['table']."&selOrder=".$selOrder."&aInput=".$aInput."&pageno=".($pageno + 1); } ?>"> <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        >
    </li></a>
    <a href="?table=<?php echo $_GET['table'] ?><?php echo '&aInput='.$aInput ?>&pageno=<?php echo $total_pages; ?>&selOrder=<?php echo $selOrder ?>"><li>Last</li></a>
</ul>

</div>

        </div>
       
        
    </div>
    </div>


    
</body>

<br>
<footer style="background-color: rgb(244,244,244); width: 100%; height: 10%; left: 0; bottom: 0;">
<br>
<p style="text-align: center; color: black;"><i>Powered by <img src="img/athena-logo.png" alt="" height="50px"></i> Database management system solutions. Clough and Chiong 2021 &copy;</p>
    <br>
</footer>
<script src="scripts/gal_script.js"></script>

</html>
