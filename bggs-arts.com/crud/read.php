<!-- Include the header that is located from an external source (outside of the subfolder) -->
<?php include('../header_admin.php') ;

?>
<head>

</head>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View <?php echo $_GET['table'] ?> Record</h1>
                        <?php
                        if ($_GET['newartwork']== 1){
                            echo '<div class="alert alert-success" role="alert">
                            Record successfully updated!
                          </div>';
                          $_SESSION['aInput'] = "";
                        } else if ($_GET['newartwork']== 2){
                            echo '<div class="alert alert-success" role="alert">
                            Record successfully created!
                          </div>';
                          $_SESSION['aInput'] = "";
                        } else {
                            $_SESSION['aInput'];
                        }
                        ?>
                    </div>
        
<?php 

        include('../connect.php'); 
           
        /// SQL required to access the data in the Artworks database using meekroDB
        

    if ($_GET['table'] == 'Artworks') {
        
        $allartworks = DB::query("SELECT a.a_id AS 'ID', a.a_title AS 'Title', CONCAT(r.a_fname,' ', r.a_lname) AS 'Artist_Name', m.m_name AS 'Media', l.room AS 'Location', a.img AS 'Image', a.year AS 'Year', a.purchase_date AS 'Purchase_Date', a.artwork_value AS 'Value' FROM artworks AS a, artists AS r, locations AS l, media AS m
        WHERE a.artist_id = r.artist_id AND a.l_id = l.l_id AND a.m_id = m.m_id AND a.a_id = ".$_GET['a_id']);
        foreach($allartworks as $row) {
                   
                
            echo'<div class="read-layout"><div class="readgrid"><div class="readgridel"><div class="form-group">
            <label>ID</label><p class="form-control-static">'.$row["ID"].'</p>
        </div>';
            echo ' <div class="form-group">
        <label>Title</label>
        <p class="form-control-static">'.$row["Title"].'</p>
        </div>';
             echo ' <div class="form-group">
            <label>Artist</label>
            <p class="form-control-static">'.$row["Artist_Name"].'</p>
        </div>';
            echo ' <div class="form-group">
            <label>Media</label>
            <p class="form-control-static">'.$row["Media"].'</p>
        </div>';
            echo ' <div class="form-group">
            <label>Location</label>
            <p class="form-control-static">'.$row["Location"].'</p>
        </div></div>'; 
            echo ' <div class="readgridel"><div class="form-group">
            <label>Year</label>
            <p class="form-control-static">'.$row["Year"].'</p>
        </div>'; 
            echo ' <div class="form-group">
            <label>Purchase Date</label>
            <p class="form-control-static">'.$row["Purchase_Date"].'</p>
        </div>';
        
             echo ' <div class="form-group">
            <label>Artwork Value</label>
            <p class="form-control-static">$'.$row["Value"].'.00</p>
        </div></div>'; 
            echo '<div class="readgridel" style="text-align: center;"> <div class="form-group" class="column">
            <label>Image</label>
            <p class="form-control-static"><img class="read_img" style="max-width: 400px; max-height: 400px;" src="data:image/jpeg;base64,'.base64_encode( $row['Image']).'"></p>';
            echo '<p class="align-mid"><a href="../dashboard.php?aInput='.$_SESSION['aInput'].'&table='.$_GET['table'].'" class="btn btnStyle" style="width: 80%;
            text-align: center;
            background-color: grey; color: white; font-size: 20px;">Back</a></p>';
        '</div></div></div>'; };

    }

    if ($_GET['table'] == 'Locations') {
        $locations = DB::query("SELECT * FROM locations WHERE l_id =".$_GET['l_id']);
        foreach ($locations AS $row) {
            echo ' <div class="form-group">
            <label>ID</label>
            <p class="form-control-static">'.$row["l_id"].'</p>
        </div>';
        echo ' <div class="form-group">
            <label>Room</label>
            <p class="form-control-static">'.$row["room"].'</p>
        </div>';
        echo ' <div class="form-group">
            <label>Building</label>
            <p class="form-control-static">'.$row["building"].'</p>
        </div>';
        echo ' <div class="form-group">
            <label>Floor</label>
            <p class="form-control-static">'.$row["floor"].'</p>
        </div>';
        }
        echo '<p><a href="../dashboard.php?table='.$_GET['table'].'" class="btn btn-primary">Back</a></p>';
    }

    if ($_GET['table'] == 'Media') {
        $media = DB::query("SELECT * FROM media WHERE m_id =".$_GET['m_id']);
        foreach ($media AS $row) {
            echo ' <div class="form-group">
            <label>ID</label>
            <p class="form-control-static">'.$row["m_id"].'</p>
        </div>';
        echo ' <div class="form-group">
            <label>Collection</label>
            <p class="form-control-static">'.$row["collection"].'</p>
        </div>';
        echo ' <div class="form-group">
            <label>Type of Media</label>
            <p class="form-control-static">'.$row["m_name"].'</p>
        </div>';
        
        }
        echo '<p><a href="../dashboard.php?table='.$_GET['table'].'" class="btn btn-primary">Back</a></p>';
    }

    if ($_GET['table'] == 'Artists') {
        $artists = DB::query("SELECT * FROM artists WHERE artist_id=".$_GET['artist_id']);
        foreach ($artists AS $row) {
            echo ' <div class="form-group">
            <label>Artist ID</label>
            <p class="form-control-static">'.$row["artist_id"].'</p>
        </div>';
        echo ' <div class="form-group">
            <label>First Name</label>
            <p class="form-control-static">'.$row["a_fname"].'</p>
        </div>';
        echo ' <div class="form-group">
            <label>Last Name</label>
            <p class="form-control-static">'.$row["a_lname"].'</p>
        </div>';
                }
                echo '<p><a href="../dashboard.php?aInput='.$_SESSION['aInput'].'table='.$_GET['table'].'" class="btn btn-dark full-width">Back</a></p>';
    }

                   
                   
 ?>
                </div>
            </div>        
        </div>
    </div>
    <br><br><br>
</body>
<br>
<footer style="background-color: rgb(244,244,244); width: 100%; height: 10%; left: 0; bottom: 0;">
<br>
<p style="text-align: center; color: black;"><i>Powered by <img src="../img/athena-logo.png" alt="" height="50px"></i> Database management system solutions. Clough and Chiong 2021 &copy;</p>
    <br>
</footer>
</html>