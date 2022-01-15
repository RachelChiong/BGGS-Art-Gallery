<?php
/// Check if this php page was accessed from 
if (isset($_POST['record-submit'])) {
    $return = $_POST['return'];
    include ("config.php"); 
   include("../../connect.php");
    $table = $_GET['table'];
    if($table == 'Artists'){
        $fname = $_POST['f_name'];
        $lname = $_POST["l_name"];
    /// Check whether all the fields are filled out
    if (empty($fname) || empty($lname)){
        header("Location: ../create.php?table=Artists&error=emptyfields&f_name=".$fname."&l_name=".$lname);
        exit();
    }
            //
            else {
                $sql = "INSERT INTO ".$table." (a_fname, a_lname) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($link);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../create.php?error=sqlerror");
                    exit(); 
                }
                /// All error handlers are cleared
                else {
                    /// Bind parameters to insert into the database
                    mysqli_stmt_bind_param($stmt, "ss", $fname, $lname);
                    /// Insert user data into the database
                    mysqli_stmt_execute($stmt);
                    if(isset($return)) {
                        echo "<script>window.close();</script>";
                    } else {
                    header("Location: ../../dashboard.php?table=Artists");
                    exit(); 
                    }
                }
            }
        
    
    //
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} 

    if($table == 'Media'){
        $m_name = $_POST['m_name'];
        $collection = $_POST['collection'];
        if (empty($m_name)){
            header("Location: ../create.php?table=Media&error=emptyfields&m_name=".$m_name);
            exit();
        }
      
                //
                else {
                    $sql = "INSERT INTO ".$table." (collection, m_name) VALUES (?,?)";
                    $stmt = mysqli_stmt_init($link);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../create.php?table=media&error=sqlerror");
                        exit(); 
                    }
                    /// All error handlers are cleared
                    else {
                      
                        mysqli_stmt_bind_param($stmt, "ss", $collection, $m_name);
                        /// Insert user data into the database
                        mysqli_stmt_execute($stmt);
                        header("Location: ../../dashboard.php?table=Media");
                        exit(); 
                    }
                }
            
        
        //
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } 
    
    if($table == 'Locations'){
        $building = $_POST['building'];
        $room = $_POST['room'];
        $floor = $_POST['floor'];
        if (empty($building || $room)){
            header("Location: ../create.php?table=Locations&error=emptyfields&building=".$building."&room=".$room."&floor=".$floor);
            exit();
        } 
      
                //
                else {
                
                $roomverify = DB::QueryFirstRow('SELECT room FROM locations WHERE room="'.$room.'"');
                if($roomverify > 0) {
                    header("Location: ../create.php?table=Locations&error=roomentered&building=".$building."&room=".$room."&floor=".$floor);
                    exit();
                } else {
                    $sql = "INSERT INTO ".$table." (room, building, floor) VALUES (?,?,?)";
                    $stmt = mysqli_stmt_init($link);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../create.php?table=Locations&error=sqlerror");
                        exit(); 
                    }
                    /// All error handlers are cleared
                    else {
                      
                        mysqli_stmt_bind_param($stmt, "ssi", $room, $building, $floor);
                        /// Insert user data into the database
                        mysqli_stmt_execute($stmt);
                        header("Location: ../../dashboard.php?table=Locations");
                        exit(); 
                    }
                }
            }
            
        
        //
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } 


if($table == 'Artworks'){
    $title = $_POST['a_title'];
    $m_id = $_POST["m_id"];
    $l_id = $_POST['l_id'];
    $artist_id = $_POST['artist_id'];
    $year = $_POST['year'];
    $purchase_date = $_POST['purchase_date'];
    $artwork_value = $_POST['artwork_value'];

    $imgdata = file_get_contents($_FILES['img']['tmp_name']);

 // Query the database using meekroDB to check whether the artist, location and media entered are stored in the database
 $fetchartist_id = DB::queryFirstRow('SELECT * FROM artists WHERE CONCAT(a_fname, " ", a_lname)= "'.$artist_id.'"');
 $fetchl_id = DB::queryFirstRow('SELECT * FROM locations WHERE room = "'.$l_id.'"');
 $fetchm_id = DB::queryFirstRow('SELECT * FROM media WHERE m_name = "'.$m_id.'"');
 // Declare error variables
 $m_iderr = $l_iderr = $artist_iderr = "";
 
 // Check if an id could be found for the inputted media. 
 if(!$fetchm_id['m_id']) {
     echo 'Could not run query: ' . mysqli_error();
     $m_iderr = "&errormedia=fetchm_iderr";

 } else { 
 // Redefine media id variable so that it can be stored in the artworks database
     $m_id = $fetchm_id['m_id']; } 
 
 // Check if an id could be found for the inputted artist
 if(!$fetchartist_id['artist_id']) {
     echo 'Could not run query: ' . mysqli_error();
     $artist_iderr = "&errorartist=fetchartist_iderr";
 } else { $artist_id = $fetchartist_id['artist_id']; } 

 // Check if an id could be found for the inputted location
 if(!$fetchl_id['l_id']) {
     echo 'Could not run query: ' . mysqli_error();
     $l_iderr ="&errorloc=fetchl_iderr";
 } else { $l_id = $fetchl_id['l_id']; }
 
 // Return all input errors at once so that users can fix them accordingly. 
 if(!$fetchm_id || !$fetchl_id || !$fetchartist_id) {
    $m_id = $_POST["m_id"];
    $l_id = $_POST['l_id'];
    $artist_id = $_POST['artist_id'];
    header("Location: ../create.php?table=Artworks&a_title=".$title."&m_id=".$m_id."&l_id=".$l_id."&artist_id=".$artist_id."&year=".$year."&purchase_date=".$purchase_date."&artwork_value=".$artwork_value.$m_iderr.$l_iderr.$artist_iderr);
    exit();
 } 
// Check if image has the correct the file extension, and is under 200 KB (what can be acccepted by the longblob format)
    if ($imgdata != NULL){
        // Declare an array containing all the valid extension types
        $allowed = array('gif', 'jpeg', 'jpg');
        $filename = $_FILES['img']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        // Check if the file extension is a valid extension type
        if (!in_array($ext, $allowed)) {
            $m_id = $_POST["m_id"];
            $l_id = $_POST['l_id'];
            $artist_id = $_POST['artist_id'];
            header("Location: ../create.php?table=Artworks&error=invalidimg&a_title=".$title."&m_id=".$m_id."&l_id=".$l_id."&artist_id=".$artist_id."&year=".$year."&purchase_date=".$purchase_date."&artwork_value=".$artwork_value);
            exit();
        // Check if the file size is greater than the accepted 200 KB
        } else if ($_FILES['img']['size'] > 200000) {
            $m_id = $_POST["m_id"];
            $l_id = $_POST['l_id'];
            $artist_id = $_POST['artist_id'];
            header("Location: ../create.php?table=Artworks&error=bigimg&a_title=".$title."&m_id=".$m_id."&l_id=".$l_id."&artist_id=".$artist_id."&year=".$year."&purchase_date=".$purchase_date."&artwork_value=".$artwork_value);
            exit();
        }
    }
    
    

/// Check whether all the fields are filled out
if (empty($title) || empty($m_id) || empty($l_id) || empty($artist_id) || empty($purchase_date) || empty($artwork_value)){
    header("Location: ../create.php?table=Artworks&error=emptyfields&a_title=".$title."&m_id=".$m_id."&l_id=".$l_id."&artist_id=".$artist_id."&year=".$year."&purchase_date=".$purchase_date."&artwork_value=".$artwork_value);
    exit();
}
  
        

// Use MeekroDB to insert artworks
            else {
           DB::insert('artworks', [
            'a_title' => $title,
            'm_id' => $m_id,
            'artist_id' => $artist_id,
            'year' => $year,
            'l_id' => $l_id,
            'purchase_date' => $purchase_date,
            'artwork_value' => $artwork_value,
            'img' => $imgdata
          ]);

          $retid = DB::queryFirstRow('SELECT a_id FROM artworks WHERE a_title="'.$title.'" AND m_id="'.$m_id.'" AND artist_id="'.$artist_id.'" AND l_id="'.$l_id.'"');
          header("Location: ../read.php?table=Artworks&newartwork=2&a_id=".$retid['a_id']);
        
        }
    
        /*
    }
        
} */

//
mysqli_stmt_close($stmt);
mysqli_close($link);
        }
    }

    