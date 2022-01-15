<?php include('../header_admin.php') ?>
<?php $path = '../bggs_arts6/';
        include('../connect.php'); 
         ?>


<main>
            <div class="grid-el" class="signup_form">
        
            <div class="page-header">
                        <h1>Update <?php echo $_GET['table'] ?> Record</h1>
                    </div>
                
            <?php
            if ($_GET['table'] == 'Artists'){
                if (isset($_GET['error'])){
                    if ($_GET['error'] == "emptyfields") {
                        echo '<p class="signuperror">Fill in all the fields.</p>';
                    }
                }
                ?>
            <form class="form-signup" action="crud_includes/update.inc.php?table=Artists " method="post">
               

                <?php  

                    //
                    if (!empty($_GET["f_name"])) {
                        echo '<input type="text" name="f_name" placeholder="First Name" label="First Name" value="'.$_GET["f_name"].'"><br>';
                    }
                    else {
                        echo '<input type="text" label="First Name" name="f_name" placeholder="First name"><br>';
                    }

                    if (!empty($_GET["l_name"])) {
                        echo '<input type="text" name="l_name" placeholder="Last Name" value="'.$_GET["l_name"].'">';
                    }
                    else {
                        echo '<input type="text" name="l_name" placeholder="Last name">';
                    }
                   

                ?>


                <button type="submit" name="record-submit">Update Record</button>
                
                <? echo '<p class="align-mid"><a href="../dashboard.php?table='.$_GET['table'].'" class="btn btnStyle" style="width: 100%;
            text-align: center;
            background-color: grey; color: white; font-size: 20px;">Back</a></p>'; ?>
            </form>
           
        </div>
                <?php } else {
                    if($_GET['table'] == 'Artworks'){
                        
                    // Check for empty fields
                            if ($_GET['error'] == "emptyfields") {
                                echo '<p class="signuperror">Fill in all the fields.</p>';
                            }
                            // Check if the artist, media and location are currently in their respective tables
                       
                        if ($_GET['errorartist'] == "fetchartist_iderr") {
                            echo '<p class="signuperror">Artist is not in database. Please select a valid artist, or create a new artist in the artist table tab.</p></n>';
                        }

                        if ($_GET['errormedia'] == "fetchm_iderr") {
                        echo '<p class="signuperror">Media type is not in database. Please select a valid media, or create a new media in the media table tab.</p></n>';
                        }
                        
                        if ($_GET['errorloc'] == "fetchl_iderr") {
                            echo '<p class="signuperror">Location is not in database. Please select a valid location, or create a new location in the location table tab.</p></n>';
                        }
                    
                      
                        
                        ?>
                    <form class="form-signup" enctype="multipart/form-data" action="crud_includes/update.inc.php?table=Artworks" method="post">
                               
                        <?php  

$allartworks = DB::queryfirstrow("SELECT a.a_id AS 'ID', a.a_title AS 'Title', CONCAT(r.a_fname,' ', r.a_lname) AS 'Artist_Name', m.m_name AS 'Media', l.room AS 'Location', a.img AS 'Image', a.year AS 'Year', a.purchase_date AS 'Purchase_Date', a.artwork_value AS 'Value' FROM artworks AS a, artists AS r, locations AS l, media AS m
WHERE a.artist_id = r.artist_id AND a.l_id = l.l_id AND a.m_id = m.m_id AND a.a_id = ".$_GET['a_id']);

        if (!isset($_GET['Title'])){
            $_GET['Title'] = $allartworks['Title'];
        }
        if (!isset($_GET['artist_id'])){
            $_GET['artist_id'] = $allartworks['Artist_Name'];
        }
        if (!isset($_GET['m_id'])){
            $_GET['m_id'] = $allartworks['Media'];
        }        
        if (!isset($_GET['year'])){
            $_GET['year'] = $allartworks['Year'];
        }
        if (!isset($_GET['l_id'])){
            $_GET['l_id'] = $allartworks['Location'];
        }
        if (!isset($_GET['purchase_date'])){
            $_GET['purchase_date'] = $allartworks['Purchase_Date'];
        }

        if (!isset($_GET['artwork_value'])) {
            $_GET['artwork_value'] = $allartworks['Value'];
        }

        if (!isset($_GET['img'])) {
            $_GET['img'] = '<img class="read_img" style="max-width: 400px; max-height: 200px;" src="data:image/jpeg;base64,'.base64_encode( $allartworks['Image']).'">';
        }
        
        
        
                            //
                            echo '<div class="artworkformgrid" style="margin-left: 10%; margin-right: 10%; column-gap: 3%;border-style: dashed;
                            border-color: rgb(0,20,137);
                            border-radius: 10px; padding: 3%; margin-top: -2%;"><div class="artworkformgridEl">';
                            echo '<input type="hidden" name="a_id" value="'.$_GET['a_id'].'">';
                            echo '<label class="createtitle">Artwork Title</label>';
                            if (!empty($_GET['Title'])) {
                                
                                echo '<input style="width: 100%" class="form-control" type="text" name="a_title" placeholder="Artwork Title" label="a_title" value="'.$_GET["Title"].'"><br>';
                            }
                            else {
                                echo '<input style="width: 100%;" class="form-control" type="text" label="a_title" name="a_title" placeholder="Artwork Title" value=""><br>';
                            };

                            echo '<label class="createtitle">Artist</label><br>';
                            echo '<p><a href="create.php?&table=Artists&return=1" target="_blank" class="btn btn-warning" style="float:right; margin-top: 2.5%; height: 30px">Add New</a></p>';
                            if (!empty($_GET['artist_id'])) {
                                echo '<div><input style="width:75%" class="form-control" placeholder="Select Artist..." autoComplete="on" list="artist_suggestions" name="artist_id" value="'.$_GET['artist_id'].'"/><datalist  id="artist_suggestions">';
                                $sql = DB::query('SELECT artist_id, CONCAT(a_fname ," ", a_lname) AS "Artist_Name" FROM artists');
                                 foreach($sql as $row) { 
                                   echo'<option class="option" value="'.$row['Artist_Name'].'" data-id="'.$row['artist_id'].'"></option>';
                                 };
                                  
                             echo '</datalist>';
                            
                                
                             }
                             else {
                                                            
                                 echo '<div><input style="width:75%" class="form-control" placeholder="Select Artist..." autoComplete="on" list="artist_suggestions" name="artist_id" value=""/><datalist  id="artist_suggestions">';
                                $sql = DB::query('SELECT artist_id, CONCAT(a_fname ," ", a_lname) AS "Artist_Name" FROM artists');
                                 foreach($sql as $row) { 
                                   echo'<option class="option" value="'.$row['Artist_Name'].'" data-id="'.$row['artist_id'].'"></option>';
                                 };
                                  
                             echo '</datalist>';
                            
                             
                            };
                            echo '<label class="createtitle">Media</label><br>';
                            echo '<p><a href="create.php?&table=Media&return=1" target="_blank" class="btn btn-warning" style="float:right; margin-top: 2.5%; height: 30px">Add New</a></p>';
                            if (!empty($_GET["m_id"])) {

                                $sql = DB::query("SELECT * FROM media");                             
                                echo '<input style="width:75%" class="form-control" placeholder="Select Media..." autoComplete="on" list="media_suggestions" name="m_id" value="'.$_GET['m_id'].'"/><datalist id="media_suggestions" name="m_id">';
                                  foreach($sql as $row) { 
                                  echo'<option class="option" label="'.$row["m_name"].'" value="'.$row["m_name"].'"></option>';
                                }
                                 
                            echo '</datalist>';                               
                             }
                             else {
                                 $sql = DB::query("SELECT * FROM media");                             
                                echo '<input style="width:75%" class="form-control" placeholder="Select Media..." autoComplete="on" list="media_suggestions" name="m_id" value="'.$_GET['m_id'].'"/><datalist id="media_suggestions" name="m_id">';
                                  foreach($sql as $row) { 
                                  echo'<option class="option" value="'.$row["m_name"].'" data-id="'.$row["m_name"].'"></option>';
                                }
                                 
                            echo '</datalist>                   
                             ';
                             
                             };
                             echo '<label class="createtitle">Location</label><br>';
                             echo '<p><a href="create.php?&table=Locations&return=1" target="_blank" class="btn btn-warning" style="float:right; margin-top: 2.5%; height: 30px">Add New</a></p>';

                            if (!empty($_GET["l_id"])) {

                                echo '<input value="'.$_GET['l_id'].'" style="width:75%" class="form-control" placeholder="Select Location..." autoComplete="on" list="loc_suggestions" name="l_id" /><datalist  id="loc_suggestions">';
                                $sql = DB::query("SELECT * FROM locations");
                                foreach($sql as $row) { 
                                  echo'<option class="option" value="'.$row["room"].'" data-id="'.$row["l_id"].'"></option>';
                                }
                                 
                            echo '</datalist></div></div><div class="artworkfromgridEl>
';
                             }
                             else {
                                 $sql = DB::query("SELECT * FROM locations");                             
                                echo ' <input style="width:75%" placeholder="Select Location..." class="form-control" autoComplete="on" list="loc_suggestions" name="l_id"/><datalist id="loc_suggestions" name="l_id">';
                                  foreach($sql as $row) { 
                                  echo'<option class="option" value="'.$row["room"].'" data-id="'.$row["l_id"].'"></option>';
                                }
                                 
                            echo '</datalist></div></div><div class="artworkfromgridEl>
                            
                             ';
                             
                             }; 
                                                        
                           echo '<label class="createtitle"><strong>Year</strong></label>';
                            if (!empty($_GET["year"])) {
                                echo '<input type="text" minlength="4" maxlength="4" name="year"placeholder="yyyy" class="date-own form-control" style="width: 90%; margin-top: 5px;" type="text"  value="'.$_GET["year"].'"><br>';
                                
                            }
                            else {
                                echo '<input type="text" minlength="4" maxlength="4" name="year" placeholder="yyyy" class="date-own form-control" style="width: 90%; margin-top: 5px;" type="text" ><br>';
                            }
                            
                            echo '<label>Date</label>';
                            if (!empty($_GET["purchase_date"])) {
                                echo '<input style="width: 90%" class="form-control date" type="date" name="purchase_date" placeholder="Purchase Date" value="'.$_GET["purchase_date"].'"><br>';
                            }
                            else {
                                echo '<input style="width: 90%" class="form-control date" type="date" name="purchase_date" placeholder="Purchase Date"><br>';
                            }
                            echo '<label>Artwork Value (to nearest dollar)</label>';
                            if (!empty($_GET["artwork_value"])) {
                                
                                echo ' <div class="input-group" style="width:90%">
                                <div class="input-group-addon" style="color: white; background-color: rgb(0,20,137)">
                                    $
                                </div><input class="form-control" type="number" name="artwork_value" placeholder="Artwork Value" value="'.$_GET['artwork_value'].'">
                                <div class="input-group-addon" style="color: white; background-color: rgb(0,20,137)">
                                .00
                            </div>
                        </div>';
                            }
                            else {
                                echo ' <div class="input-group" style="width:90%">
                                <div class="input-group-addon" style="color: white; background-color: rgb(0,20,137)">
                                    $
                                </div><input class="form-control" type="number" name="artwork_value" placeholder="Artwork Value">
                                <div class="input-group-addon" style="color: white; background-color: rgb(0,20,137)">
                                .00
                            </div>
                        </div>';
                            }

                            echo '</div><div class="artworkformgridEl">';
                                echo '<input style="width: 80%;" class="form-control-file" type="file" name="img" onchange="previewFile()"><br>';
                                echo '<ul style="float: left;"><li>Image must be under 200 KB</li>';
                                echo '</li>Image must be a .gif, .jpg or .jpeg</li><ul><br>';
                                echo '<label>New Image</label><br>';
                                echo '<img src="" name="preview" height="150" alt="New Image preview..."><br>';
                                echo '<label>Existing Image</label><br>';
                                echo $_GET['img'];
                                
                                
                                                  
        
                        ?>
        
        
                        <button type="submit" name="record-submit" style="width: 100%; margin-bottom: 1%;" >Update Record</button>
                        
                        <? echo '<p class="align-mid"><a href="../dashboard.php?aInput='.$_SESSION['aInput'].'&table='.$_GET['table'].'" class="btn btnStyle" style="width: 100%;
            text-align: center;
            background-color: grey; color: white; font-size: 20px;">Back</a></p>';
        '</div></div></div>';?>
                        
                    </form>
                   
                </div> <?php
                    } else {
                        if($_GET['table'] == 'Media') {
                            if (isset($_GET['error'])){
                                if ($_GET['error'] == "emptyfields") {
                                    echo '<p class="signuperror">Fill in all the fields.</p>';
                                }
                              
                            ?>
                        <form class="form-signup" action="crud_includes/create.inc.php?table=Media " method="post">
                           
            
                            <?php  
            
                                //
                                if (!empty($_GET["m_name"])) {
                                    echo '<input type="text" name="m_name" placeholder="Media" label="m_name" value="'.$_GET["m_name"].'"><br>';
                                } else {
                                    echo '<datalist id="suggestions">';
                                    $locations = DB::query("SELECT DISTINCT m_name, m_id FROM Media ORDER BY m_name");
                                    foreach($locations as $row) { 
                                      echo'<option class="option" value="'.$row['m_id'].'">'.$row['m_name'].'</option>';
                                    };
                                     
                                echo '</datalist>
                                 <input placeholder="Location..." autoComplete="on" list="suggestions"/> 
                                     ';
                                 
                                }
                               
            
                            ?>
            
            
                            <button type="submit" name="record-submit">Add Record</button>
                            
                            <? echo '<p><a href="../dashboard.php?table=Media" class="btn btn-primary">Back</a></p>'; ?>
                        </form>
                       
                    </div>

                     <?php   } else {
                            if($_GET['table'] == 'Locations'){

                            }
                        }
                    }
                }
            }
           ?>
<script>
function previewFile() {
  var preview = document.querySelector('img[name="preview"]');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}



$('.date-own').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });

</script>

   
</main>
<br>
    <br>   
    <footer style="background-color: rgb(244,244,244); width: 100%; height: 10%; left: 0; bottom: 0;">
<br>
<p style="text-align: center; color: black;"><i>Powered by <img src="../img/athena-logo.png" alt="" height="50px"></i> Database management system solutions. Clough and Chiong 2021 &copy;</p>
    <br>
</footer>