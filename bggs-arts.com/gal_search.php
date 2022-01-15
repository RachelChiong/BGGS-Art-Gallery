<?php $pagetitle='Gallery Search'; include_once 'header.php'; 
$_GET['table'] = 'artworks';
?>
<?php $title = 'Gallery Search'; include 'splash_title.php' ;
echo '<div style="height: 20px"></div>';

if(!isset($_SESSION['userType'])) {
  echo '<p style="margin-top: 100px; text-align: center;">Please <a href="#" style="color: rgb(0,20,137)"><b>login</b></a> to access the page</p> <br> <p style="text-align: center; padding-bottom: 100px;">Need an account? Contact the administrator for your login details. <br> If you are not part of the BGGS staff and student community, create an account for free <a href="signup.php" style="color: rgb(0, 20, 137)"><b>here</b></a></p>';
        include_once 'footer.php';
        /// Kill the php scripts that contain the database connection and the catalogue when the user has not signed in. 
        exit();
}
include('connect.php');
session_start();
$aInput = $_GET['aInput'] = $_SESSION['aInput']; 
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

if (isset($_GET['resultsdisp'])) {
    session_start();
    $_SESSION['resultsdisp'] = $_GET['resultsdisp'];
    $resultsdisp = $_SESSION['resultsdisp'];
} else {
    $resultsdisp = 10;
}

if(isset($_GET['selOrder'])) {
    $selOrder = $_GET['selOrder'];
} else {
    $selOrder = 'a_id';
}


$no_of_records_per_page = $resultsdisp;
$offset = ($pageno - 1) * $no_of_records_per_page;

if($aInput == NULL) {
$result = DB::queryraw("SELECT COUNT(*) FROM artworks");
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page); }
?>
    
<style>
.ret_img {
  width: 50px;
  height: auto;
}

.topnavGrid {
  display: grid;
grid-template-columns: 15% 70% 5% 10%;
padding-bottom: 1%;
}

.topnavGridEl {
grid-row-start: 1;
grid-row-end: 3;
}

.p1 {
  margin-top: 100px;
}

@media only screen and (max-width: 800px) {

  .header_cont {
    margin-top: -200px;
  }
    .gal_layout {
        display: block;
        max-width: 100%;
    }

  #gal_table th {
    font-size: 10px;
    
  }

  th {
    font-size: 18px;
  }
  td {
    padding: 3px;
    padding-left: 10px;
    font-size: 12px;
  }

  #resText {
    font-size: 10px;
  }

/*... */
    .ret_img {
      height: 50px;
      width: auto;
    }
    .page_title {
      font-size: 200%;
      text-align: center;
    }
    .bggs_text {
      font-size: 100%;
    }
} 

    </style>
</head>
<body>


 <!--- Organising the components into a grid makes the webpage more engaging as there is a balance. A separate div including the two 'grid items' is needed  -->
 <div class="gal_layout">
   <div class="search_cont">
 <div class="demo">
  <h3 style="font-family: 'Times New Roman';"><strong>Filters</strong></h3>
  <!-- Dropdown list of artists -->
    <div class="material-input material-select">
              <div class="main-input">select</div>
              <select name="select1" id="dropDownArtist" style="float: right; border: none;">
              <input type="text" id="material-select" readonly style="display:none">
              <span class="placeholder">Artist</span>
              <ul class="dropdown-list" style="display: none;">
              
             <!--- Retrieve artists in the database -->
              <?php 
          
              $artists = DB::query("SELECT artist_id, a_fname, a_lname,  CONCAT(a_fname,' ', a_lname) AS 'Artist_Name' FROM Artists");
              foreach($artists as $row) { 
                echo'<option class="option" value="'.$row['Artist_Name'].'">'.$row['Artist_Name'].'</option>';
              }
              
              ?>
              
              </ul>
              </select>
    </div>
<!-- Drop down list of media options  -->
    <div class="material-input material-select">
              <div class="main-input">select</div>
              <select name="select1" id="dropDownMedia" style="float: right; border: none;">
              <input type="text" id="material-select2"  placeholder="search..." id="myinput" onkeyup="filterFunction()">
              <span class="placeholder">Media</span>
              <ul class="dropdown-list" style="display: none;">
              <!-- Retrieve list of media options from the database -->
              <?php 
              require_once 'connect.php';
              $media = DB::query("SELECT DISTINCT m_name FROM Media ORDER BY m_name");
              foreach($media as $row) { 
                echo'<option class="option" value="'.$row['m_name'].'">'.$row['m_name'].'</option>';
              }
               
              ?>
              </ul>
              </select>
    </div>
<!-- drop down list of building options -->
    <div class="material-input material-select">
              <div class="main-input">select</div>
              <select name="select1" id="dropDownBuilding" style="float: right; border: none;">
              <input type="text" id="material-select2" readonly style="display:none">
              <span class="placeholder">Building</span>
              <ul class="dropdown-list" style="display: none;">
              <!-- Retrieve building options -->
              <?php 
              require_once 'connect.php';
              $locations = DB::query("SELECT DISTINCT building FROM locations");
              foreach($locations as $row) { 
                echo'<option class="option" value="'.$row['building'].'">'.$row['building'].'</option>';
              }
               
              ?>
              </ul>
              </select>
    </div>


            </div> 
  
    </div>
   
    <!-- Create the search table -->
    <div class="searchTable">
    <div class="topbar">
    
    </div>
        <?php 
   
        require_once 'connect.php'; 
        echo '<div class="topnavGrid"><div class="topnavGridEl"></div>';
        echo '
        <div class="topnavGridEl">
        <!-- Search input adapted from Sergey Ioffe from Codepen.io Source: https://codepen.io/sergey_ioffe/pen/XoXpjE -->
        <input type="text" maxwidth="80" class="search_input" id="myInput" placeholder="General search" 
        onfocus="this.placeholder = """
        onblur="this.placeholder = "Search"" autofocus required />
        </div>';
        echo '<div class="topnavGridEl" id="resText" style="margin-top: 15%">Results</div><div class="topnavGridEl"><select class="form-control form-control-sm">
        <option></option>
        <option>5</option>
        <option>10</option>
      </select></div></div>';
        
      
      /// SQL required to access the data in the Artworks database using meekroDB
     
      $res_data = DB::query("SELECT a.a_id AS 'ID', a.a_title AS 'Title', CONCAT(r.a_fname,' ', r.a_lname) AS 'Artist_Name', m.m_name AS 'Media', l.room AS 'Location', a.img AS 'Image', a.year AS 'Year', a.purchase_date AS 'Purchase_Date', a.artwork_value AS 'Value' FROM artworks AS a, artists AS r, locations AS l, media AS m
      WHERE a.artist_id = r.artist_id AND a.l_id = l.l_id AND a.m_id = m.m_id ORDER BY $selOrder LIMIT $offset, $no_of_records_per_page");
      /// Construct the table
        echo '<table class="table">';
        echo '<tr class="tb_head">
          <th>Title</th>
          <th>Artist</th>
          <th>Media</th>
          <th>Location</th>
          <th align="center">Image</th>';
          
        /// Uses iteration to print the rows into the search table
          foreach($res_data as $row) {
          echo '<tbody id="gal_table"><tr class="atr"><td>'.$row['Title'].'</td>';
          echo '<td>'.$row['Artist_Name'].'</td>';
          echo '<td>'.$row['Media'].'</td>';
          /// If the user has signed in, the location will be displayed. This line is missing for general users
          echo '<td>'.$row['Location'].'</td>';
          echo '<td><img id="'.$row['ID'].'" class="ret_img imagebtn" src="data:image/jpeg;base64,'.base64_encode( $row['Image']).'"></td></tr>';
          
          
      } 
      /// Distinguish where the table ends. 
      echo '</tbody></table>';
      
        

        ?>

<div id="imgModal" class="imgModalclass">

<!-- The Close Button -->
<span class="close">&times;</span>

<!-- Modal Content (The Image) -->

<div id="caption"></div>
</div>
<script>
 $('.imagebtn').on('click', function(e){
   alert('hello');
 })
</script>

<div style="text-align: center">
<div class="pagination p1" style="margin-top: 10px;">
<ul>
<?php $_GET['table'] = 'Artworks' ?>
<a href="?table=<?php echo $_GET['table'] ?>&pageno=1"><li>First</li></a>

<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?table=".$_GET['table']."&pageno=".($pageno - 1); } ?>"> <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
       <
    </li></a>

<?php 

for ($i=0; $i < $total_pages; $i++) {
    if($pageno == ($i+1)) {
        $active = 'is-active';
    } else {
        $active = '';
    };
    echo '<a href="?table='.$_GET['table'].'&pageno='.($i + 1).'" name="pagniation" value="'.($i +1).'" class="'.$active.'"><li>'.($i + 1).'</li></a>';
}
 ?>
   <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?table=".$_GET['table']."&pageno=".($pageno + 1); } ?>"> <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        >
    </li></a>
    <a href="?table=<?php echo $_GET['table'] ?>&pageno=<?php echo $total_pages; ?>"><li>Last</li></a>
</ul>
</div>
</div>

        </div>
       
        
    </div>
    </div>


    

<script src="scripts/gal_script.js"></script>

<?php echo '<br><br>';
include 'footer.php' ?>