<?php include('../header_admin.php');
        include('../connect.php');
        ?>

<style>
.alert {
  width: 85%;
  text-align: center;
  margin-right: 10%;
  margin-left: 6%;
}

.asterisk {
  color: red;
}
</style>
<main>
            <div class="grid-el" class="signup_form">
        
            <div class="page-header">
                        <h1>Create <?php echo $_GET['table'] ?> Record</h1>
                    </div>
                
            <?php
            if ($_GET['table'] == 'Artists'){
                if (isset($_GET['error'])){
                    if ($_GET['error'] == "emptyfields") {
                        echo '<p class="signuperror">Fill in all the fields.</p>';
                    }
                } ?>
            <form class="form-signup" action="crud_includes/create.inc.php?table=Artists " method="post">
                <?php  

                    if ($_GET['error'] == "emptyfields") {
                    echo '<div class="alert alert-danger" role="alert">Fill in all the fields.</div>'; }
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

                    if(isset($_GET['return'])){
                        echo '<input type="text" name="return" value="1" hidden />';
                    }
                   

                ?>


                <button type="submit" name="record-submit" style="margin-bottom: 5px;">Add Record</button>
                
                <? if (isset($_GET['return'])){
                    echo '<div style="text-align: center; margin-left: 25%;" onclick="self.close()"><p class="align-mid" style="width: 66.7%"><a href="#" class="btn btnStyle" style="width: 100%;
                    text-align: center;
                    background-color: grey; color: white; font-size: 20px;">CLOSE</a></p></div>';
                } else {echo '<div style="text-align: center; margin-left: 25%;"><p class="align-mid" style="width: 66.7%"><a href="../dashboard.php?table='.$_GET['table'].'" class="btn btnStyle" style="width: 100%;
                    text-align: center;
                    background-color: grey; color: white; font-size: 20px;">BACK</a></p></div>'; }?>
            </form>
           
        </div>
                <?php } else {
        if($_GET['table'] == 'Artworks'){
            
        // Check for empty fields
            if ($_GET['error'] == "emptyfields") {
                echo '<div class="alert alert-danger" role="alert">Fill in all the fields.</div>';

        // Check for valid image extension
            } else if ($_GET['error'] == 'invalidimg') {
                echo '<div class="alert alert-danger" role="alert">Image must be: .jpg, .jpeg or .gif</div>';
        // Check whether image is under 200 KB

            } else if ($_GET['error'] == 'bigimg') {
                echo '<div class="alert alert-danger" role="alert">Image must be <200Kb </div>'; }

        // Check if the artist, media and location are currently in their respective tables
        if ($_GET['errorartist'] == "fetchartist_iderr"){
            echo '<div class="alert alert-danger" role="alert">Artist is not in database. Please select a valid artist, or create a new artist in the artist table tab.</div></n>'; }
            
        if ($_GET['errormedia'] == "fetchm_iderr") {
            echo '<div class="alert alert-danger" role="alert">Media type is not in database. Please select a valid media, or create a new media in the media table tab.</div></n>';}

        if ($_GET['errorloc'] == "fetchl_iderr") {
            echo '<div class="alert alert-danger" role="alert">Location is not in database. Please select a valid location, or create a new location in the location table tab.</div></n>'; } ?>
            
        <form class="form-signup" enctype="multipart/form-data" action="crud_includes/create.inc.php?table=Artworks" method="post">
        
<?php  
        // Display artworks form
        echo '<div style="border-style: dashed;
        border-color: rgb(0,20,137);
        border-radius: 10px; margin-right: 10%;
        margin-left: 7%; padding: 2% 0% 0% 5%;"><div class="artworkformgrid" style="column-gap: 5%;"><div class="artworkformgridEl" style="width: 110%">';
        echo '<label class="createtitle">Artwork Title<span class="asterisk">*</span>';
        if (!empty($_GET["a_title"])) {
            echo '<input style="width: 125%" class="form-control" type="text" name="a_title" placeholder="Artwork Title" label="a_title" value="'.$_GET["a_title"].'"></label><br>';
        } else {
            echo '<input style="width: 125%;" class="form-control" type="text" label="a_title" name="a_title" placeholder="Artwork Title"></label><br>'; };
        echo '<label class="createtitle">Artist<span class="asterisk">*</span></label><br>';
        // Open a new window to add a new artist
        echo '<p><a href="create.php?&table=Artists&return=1" target="_blank" class="btn btn-warning" style="float:right; margin-top: 2.5%; height: 30px">Add New</a></p>';
        if (!empty($_GET["artist_id"])) {
            // User inputs artist with auto-complete suggestions
            echo '<div><input style="width:75%" class="form-control" placeholder="Select Artist..." autoComplete="on" list="artist_suggestions" name="artist_id" value="'.$_GET['artist_id'].'"/><datalist  id="artist_suggestions">';
            // Retrieve artists for autocomplete suggestions
            $sql = DB::query('SELECT artist_id, CONCAT(a_fname ," ", a_lname) AS "Artist_Name" FROM artists ORDER BY a_fname ASC');
            // Display autocomplete suggestions as options
                foreach($sql as $row) { 
                echo'<option class="option" value="'.$row['Artist_Name'].'" data-id="'.$row['artist_id'].'"></option>';
                };
            echo '</datalist>';            
            } else {                    
                echo '<div><input style="width:75%" class="form-control" placeholder="Select Artist..." autoComplete="on" list="artist_suggestions" name="artist_id" value="'.$_GET['artist_id'].'"/><datalist  id="artist_suggestions">';
            $sql = DB::query('SELECT artist_id, CONCAT(a_fname ," ", a_lname) AS "Artist_Name" FROM artists ORDER BY a_fname ASC');
                foreach($sql as $row) { 
                echo'<option class="option" value="'.$row['Artist_Name'].'" data-id="'.$row['artist_id'].'"></option>';
                };
            echo '</datalist>';
        };
        echo '<label class="createtitle">Media<span class="asterisk">*</span></label><br>';
        // Open a new window to add a new artist
        echo '<p><a href="create.php?&table=Media&return=1" target="_blank" class="btn btn-warning" style="float:right; margin-top: 2.5%; height: 30px">Add New</a></p>';
        if (!empty($_GET["m_id"])) {
        // User inputs media with auto-complete suggestions                              
            echo '<input style="width:75%" class="form-control" placeholder="Select Media..." autoComplete="on" list="media_suggestions" name="m_id" value="'.$_GET['m_id'].'"/><datalist id="media_suggestions" name="m_id">';
            // Retrieve media for autocomplete suggestions
            $sql = DB::query("SELECT * FROM media ORDER BY m_name ASC");
            // Display autocomplete suggestions as options
                foreach($sql as $row) { 
                echo'<option class="option" label="'.$row["m_name"].'" value="'.$row["m_id"].'"></option>';
            } echo '</datalist>';                               
            } else {
                $sql = DB::query("SELECT * FROM media ORDER BY m_name ASC");                             
            echo '<input style="width:75%" class="form-control" placeholder="Select Media..." autoComplete="on" list="media_suggestions" name="m_id" value="'.$_GET['m_id'].'"/><datalist id="media_suggestions" name="m_id">';
                foreach($sql as $row) { 
                echo'<option class="option" value="'.$row["m_name"].'" data-id="'.$row["m_id"].'"></option>';
            } echo '</datalist>'; };
            echo '<label class="createtitle">Location<span class="asterisk">*</span></label><br>';
            echo '<p><a href="create.php?&table=Locations&return=1" target="_blank" class="btn btn-warning" style="float:right; margin-top: 2.5%; height: 30px">Add New</a></p>';

        if (!empty($_GET["l_id"])) {
            // User inputs location with auto-complete suggestions  
            echo '<input style="width:75%" class="form-control" placeholder="Select Location..." autoComplete="on" list="loc_suggestions" name="l_id" value="'.$_GET['l_id'].'"/><datalist  id="loc_suggestions">';
            // Retrieve location for autocomplete suggestions
            $sql = DB::query("SELECT * FROM locations ORDER BY room ASC");
            // Display autocomplete suggestions as options
            foreach($sql as $row) { 
                echo'<option class="option" value="'.$row["room"].'" data-id="'.$row["l_id"].'"></option>';
            } echo '</datalist></div></div><div class="artworkfromgridEl>';
            } else {
                $sql = DB::query("SELECT * FROM locations");                             
            echo ' <input style="width:75%" placeholder="Select Location..." class="form-control" autoComplete="on" list="loc_suggestions" name="l_id"/><datalist id="loc_suggestions" name="l_id">';
                foreach($sql as $row) { 
                echo'<option class="option" value="'.$row["room"].'" data-id="'.$row["l_id"].'"></option>'; }
             echo '</datalist></div></div><div class="artworkfromgridEl>'; }
        // Test text-input contains any other characters except for numbers. Ensures that a year is entered, as 4 characters are required for submission.
        echo '<label class="createtitle"><strong>Year</strong></label>';
        if (!empty($_GET["year"])) {
            echo '<input type="text" minlength="4" maxlength="4" name="year"placeholder="yyyy" class="date-own form-control" style="width: 90%; margin-top: 5px;" type="text"  onkeydown="return ( event.ctrlKey || event.altKey 
            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
            || (95<event.keyCode && event.keyCode<106)
            || (event.keyCode==8) || (event.keyCode==9) 
            || (event.keyCode>34 && event.keyCode<40) 
            || (event.keyCode==46) )" value="'.$_GET["year"].'"><br>';
        } else {
            echo '<input type="text" minlength="4" maxlength="4" name="year" placeholder="yyyy" class="date-own form-control" style="width: 90%; margin-top: 5px;" onkeydown="return ( event.ctrlKey || event.altKey 
            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
            || (95<event.keyCode && event.keyCode<106)
            || (event.keyCode==8) || (event.keyCode==9) 
            || (event.keyCode>34 && event.keyCode<40) 
            || (event.keyCode==46) )" type="text" ><br>'; }
        
        // 
        echo '<label>Date of Purchase<span class="asterisk">*</span></label>';
        if (!empty($_GET["purchase_date"])) {
            echo '<input style="width: 90%" class="form-control date" type="date" name="purchase_date" placeholder="Purchase Date" value="'.$_GET["purchase_date"].'" required><br>';
        } else {
            echo '<input style="width: 90%" class="form-control date" type="date" name="purchase_date" placeholder="Purchase Date" required><br>'; }
        
        echo '<label>Artwork Value (to nearest dollar)<span class="asterisk">*</span></label>';
        if (!empty($_GET["artwork_value"])) {
            echo '<div class="input-group" style="width:90%">
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
            </div><input class="form-control" type="number" name="artwork_value" placeholder="Artwork Value" value="'.$_GET['artwork_value'].'">
            <div class="input-group-addon" style="color: white; background-color: rgb(0,20,137)">
            .00
        </div>
    </div>';
        }

        echo '</div><div class="artworkformgridEl">';
        echo '<label>Artwork Image</label>';
            echo '<input style="width: 70%" class="form-control-file" type="file" name="img" onchange="previewFile()"><br>';
            echo '<ul style="float: left;"><li>Image must be under 200 KB</li>';
            echo '</li>Image must be a .gif, .jpg or .jpeg</li><ul><br>';
            echo '<img src="" name="preview" height="200" alt="Image preview...">';
            
                                

    ?>


                        <button type="submit" name="record-submit" style="width: 100%; margin-bottom: 1%;" >Add Record</button>
                        
                        <? echo '<p class="align-mid"><a href="../dashboard.php?aInput='.$_SESSION['aInput'].'&table='.$_GET['table'].'" class="btn btnStyle" style="width: 100%;
            text-align: center;
            background-color: grey; color: white; font-size: 20px;">Back</a></p>'; 
                          echo '</div></div></div>';?>
                        
                    </form>
                   
                </div> <?php
                    } else {
                        if($_GET['table'] == 'Media') {
                            if (isset($_GET['error'])){
                                if ($_GET['error'] == "emptyfields") {
                                    echo '<div class="alert alert-danger" role="alert">Fill in all the fields.</div>';
                                }
                               
                            }
                            ?>
                        <form class="form-signup" action="crud_includes/create.inc.php?table=Media " method="post">
                           
            
                            <?php  
            
                                //
                                if (!empty($_GET["m_name"])) {
                                    echo '<input type="text" name="m_name" placeholder="Media" label="m_name" value="'.$_GET["m_name"].'"><br>';
                                } else {
                                    echo '<input type="text" name="m_name" placeholder="Media" label="m_name"><br>';
                                    };
                                    if (!empty($_GET["collection"])) {
                                        echo '<input type="text" name="collection" placeholder="collection" label="collection" value="'.$_GET["collection"].'"><br>';
                                    } else {
                                        echo '<input type="text" name="collection" placeholder="collection" label="collection"><br>';
                                        };
                              
                               
            
                            ?>
            
            
                            <button type="submit" name="record-submit">Add Record</button>
                            
                            <? echo '<p><a href="../dashboard.php?table=Media" class="btn btn-primary">Back</a></p>'; ?>
                        </form>
                       
                    </div>

                     <?php   } else {
                            if($_GET['table'] == 'Locations'){
                                if(isset($_GET['error'])){
                                if($_GET['error'] == 'emptyfields'){ echo '<div class="alert alert-danger" role="alert">Fill in all the fields.</div>'; }
                                else  if($_GET['error'] == 'roomentered'){ echo '<div class="alert alert-danger" role="alert">Room already in database. Enter a new room.</div>'; } }
                                    echo ' <form class="form-signup" action="crud_includes/create.inc.php?table=Locations " method="post">';
                                    if (!empty($_GET["building"])) {
                                        echo '<input type="text" name="building" placeholder="Building" label="building" value="'.$_GET["building"].'"><br>';
                                    } else {
                                        echo '<input type="text" name="building" placeholder="Building" label="building"><br>';
                                        };
                                    if (!empty($_GET["room"])) {
                                        echo '<input type="text" name="room" placeholder="Room" label="room" value="'.$_GET["room"].'"><br>';
                                    } else {
                                        echo '<input type="text" name="room" placeholder="Room" label="room"><br>';
                                        };
                                    if (!empty($_GET["floor"])) {
                                        echo '<input type="number" name="floor" placeholder="floor" label="floor" value="'.$_GET["floor"].'"><br>';
                                    } else {
                                        echo '<input type="number" name="floor" placeholder="Floor" label="floor"><br>';
                                        }; ?>
                                         <button type="submit" name="record-submit">Add Record</button>
                            
                            <? echo '<p><a href="../dashboard.php?table=Locations" class="btn btn-primary">Back</a></p>'; ?>
                        </form>
                       
                    </div>
                    <?php
                                
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


       function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

</script>
    
        
    
</main>
<footer style="background-color: rgb(244,244,244); width: 100%; height: 10%; left: 0; bottom: 0;">
<br>
<p style="text-align: center; color: black;"><i>Powered by <img src="../img/athena-logo.png" alt="" height="50px"></i> Database management system solutions. Clough and Chiong 2021 &copy;</p>
    <br>
</footer>