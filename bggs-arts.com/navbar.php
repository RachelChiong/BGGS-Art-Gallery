<style>
#myInput {
  box-sizing: border-box;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
  border-bottom: 1px solid #ddd;
}

.active_table {
    background-color:rgb(0,20,137);
    width: 120%;
  }


</style>

<div class="search_Cont" style="text-align: center;">

<div class='dashnav' style="border: black;">
      <h3><strong>Tables</strong></h3>
    <ul class='dashnav_ul' id="pageSubmenu">
    
        <li class='dashnav_li'>
            <a href="dashboard.php?table=Artworks&resetsearch=" class="<?php if($_GET['table'] == 'Artworks'){ echo 'active_table" style="color: white';} ?>">Artworks</a>
        </li>
        <li class='dashnav_li'>
            <a href="dashboard.php?table=Artists" class="<?php if($_GET['table'] == 'Artists'){ echo 'active_table" style="color: white';} ?>">Artists</a>
        </li>
        <li class='dashnav_li'>
            <a href="dashboard.php?table=Media" class="<?php if($_GET['table'] == 'Media'){ echo 'active_table" style="color: white';} ?>">Media</a>
        </li>
    
        <li class='dashnav_li'>
        <a href="dashboard.php?table=Locations" class="<?php if($_GET['table'] == 'Locations'){ echo 'active_table" style="color: white';} ?>">Locations</a>
        </li>
        <hr style="margin-left: 4px; width: 100%; border-color: black;  border-radius: 3px;">
        <li class='dashnav_li'>
        <a href="dashboard.php?table=Users" class="<?php if($_GET['table'] == 'Users'){ echo 'active_table" style="color: white';} ?>">Users</a>
        </li>
    </ul>
    </div>
   

<!-- Code for dropdowns adapted from 'Material Design Input' by Luis Segovia on Codepen.io Source: https://codepen.io/vormundmage/pen/brzdze -->
  
<div class="demo" style="margin-top: 0px">
  <h3 style="font-family: 'Times New Roman';"><strong>Filters</strong></h3>
    <div class="material-input material-select">
              <div class="main-input">select</div>
              <select alt="Filter by Artist" name="select1" id="dropDownArtist" style="float: right; border: none;">
              <input type="text" id="material-select" readonly style="display:none">
              <span class="placeholder">Artist</span>
              <ul class="dropdown-list" style="display: none;">
              
             
              <?php 
              require_once 'connect.php';
              $artists = DB::query("SELECT artist_id, a_fname, a_lname,  CONCAT(a_fname,' ', a_lname) AS 'Artist_Name' FROM Artists");
              foreach($artists as $row) { 
                echo'<option class="option" value="'.$row['Artist_Name'].'">'.$row['Artist_Name'].'</option>';
              }
              
              ?>
              
              </ul>
              </select>
    </div>

    <div class="material-input material-select">
              <div class="main-input">select</div>
              <select alt="Filter by Media" name="select1" id="dropDownMedia" style="float: right; border: none;">
              <input type="text" id="material-select2"  placeholder="search..." id="myinput" onkeyup="filterFunction()">
              <span class="placeholder">Media</span>
              <ul class="dropdown-list" style="display: none;">
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

    <div class="material-input material-select">
              <div class="main-input">select</div>
              <select alt="Filter by Building" name="select1" id="dropDownBuilding" style="float: right; border: none;">
              <input type="text" id="material-select2" readonly style="display:none">
              <span class="placeholder">Building</span>
              <ul class="dropdown-list" style="display: none;">
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
    <br>
    <br>

    <img src="img/athena-logo.png" width="220px" alt="Athena Logo">

    <div style="margin-top: -20px"></div>
  
    </div>
    </div>