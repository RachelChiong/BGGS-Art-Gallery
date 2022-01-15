<?php include('crud_includes/config.php');
$result = mysqli_query($link,"SELECT * FROM artists");
include('../connect.php');
include('../header_admin.php');
?>

<!DOCTYPE html>
<html>
    <style>
        .btn:hover {
  opacity: 0.7;
}

.align-mid {
    text-align: center;
}
    </style>
<head>

<title>Delete data</title>
</head>
<body>
	<?php
	if ($_GET['table'] == 'Artists') {
        $artists = DB::query("SELECT * FROM artists WHERE artist_id=".$_GET['id']);
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
                echo '<a href="crud_includes/delete.inc.php?table=artists&artist_id='.$row["artist_id"].'">Delete</a>'; }
    
    if ($_GET['table'] == 'Artworks') {
        echo '<div class="alert alert-danger" role="alert" style="width: 85%; text-align: center; margin-left: 7%; margin-top: 1%;">
        <h4 class="alert-heading">Are you sure you want to delete this record?</h4>
        <p>Once a record is deleted, it cannot be recovered again.</p>
      </div>';
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
            echo '<div class="readgridel"> <div class="form-group" class="column">
            <label>Image</label>
            <p class="form-control-static" style="text-align: center;"><img class="read_img" style="max-width: 400px; max-height: 400px;" src="data:image/jpeg;base64,'.base64_encode( $row['Image']).'"></p>';
            echo '<p class="align-mid"><a href="crud_includes/delete.inc.php?table=Artworks&a_id='.$row["ID"].'" class="btn btnStyle" style="width: 80%;
            text-align: center;
            background-color: rgb(255,88,93); color: white; font-size: 20px;" >Delete</a></p>';

            echo '<p class="align-mid"><a href="../dashboard.php?aInput='.$_SESSION['aInput'].'&table='.$_GET['table'].'" class="btn btnStyle" style="width: 80%;
            text-align: center;
            background-color: grey; color: white; font-size: 20px;">Back</a></p>';
        '</div></div></div>'; };

    }
	
	
	?>
</table>
</body>
</div></div></div>
<br>
<footer style="background-color: rgb(244,244,244); width: 100%; height: 10%; left: 0; bottom: 0;">
<br>
<p style="text-align: center; color: black;"><i>Powered by <img src="../img/athena-logo.png" alt="" height="50px"></i> Database management system solutions. Clough and Chiong 2021 &copy;</p>
    <br>
</footer>
</html>
