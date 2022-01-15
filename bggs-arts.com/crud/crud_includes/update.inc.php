<?php
/// Check if this php page was accessed from 
if (isset($_POST['record-submit'])) {

    include "config.php";
    /// Assigning variables to data collected from the sign up form ('Post' is case sensitive) 
   include("../../connect.php");
   
    $table = $_GET['table'];
    
    if($table == 'Artworks'){
        $a_id = $_POST["a_id"];
        $title = $_POST['a_title'];
        $m_id = $_POST["m_id"];
        $l_id = $_POST['l_id'];
        $artist_id = $_POST['artist_id'];
        $year = $_POST['year'];
        $purchase_date = $_POST['purchase_date'];
        $artwork_value = $_POST['artwork_value'];
        $existingImg = DB::queryFirstRow('SELECT img FROM artworks WHERE a_id="'.$a_id.'"');
        $imgdata = file_get_contents($_FILES['img']['tmp_name']);

        // Keep existing image if new image is not uploaded. 
        if ($imgdata == NULL) {
            $imgdata = $existingImg['img'];
        } else {
            
// Check if image has the correct the file extension, and is under 200kb (what can be acccepted by the longblob format)
        $allowed = array('gif', 'jpeg', 'jpg');
        $filename = $_FILES['img']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            header("Location: ../create.php?table=Artworks&error=invalidimg&a_title=".$title."&m_id=".$m_id."&l_id=".$l_id."&artist_id=".$artist_id."&year=".$year."&purchase_date=".$purchase_date."&artwork_value=".$artwork_value);
            exit();
        } else if ($_FILES['img']['size'] > 200000) {
            header("Location: ../create.php?table=Artworks&error=bigimg&a_title=".$title."&m_id=".$m_id."&l_id=".$l_id."&artist_id=".$artist_id."&year=".$year."&purchase_date=".$purchase_date."&artwork_value=".$artwork_value);
            exit();
        }
    }
        
    
    /// Check whether all the fields are filled out
    if (empty($title) || empty($m_id) || empty($l_id) || empty($artist_id) || empty($purchase_date) || empty($artwork_value)){
        header("Location: ../update.php?table=Artworks&error=emptyfields&a_id=".$a_id."&a_title=".$title."&m_id=".$m_id."&l_id=".$l_id."&artist_id=".$artist_id."&year=".$year."&purchase_date=".$purchase_date."&artwork_value=".$artwork_value);
        exit();
    }
      
            else {
                
                $fetchartist_id = DB::queryFirstRow('SELECT * FROM artists WHERE CONCAT(a_fname, " ", a_lname)= "'.$artist_id.'"');
                $fetchl_id = DB::queryFirstRow('SELECT * FROM locations WHERE room = "'.$l_id.'"');
                $fetchm_id = DB::queryFirstRow('SELECT * FROM media WHERE m_name = "'.$m_id.'"');
                $m_iderr = $l_iderr = $artist_iderr = "";
                
    
                if(!$fetchm_id['m_id']) {
                    echo 'Could not run query: ' . mysqli_error();
                    $m_iderr = "&errormedia=fetchm_iderr";
    
                } else { 
                    $m_id = $fetchm_id['m_id']; } 
    
                if(!$fetchartist_id['artist_id']) {
                    echo 'Could not run query: ' . mysqli_error();
                    $artist_iderr = "&errorartist=fetchartist_iderr";
                } else { $artist_id = $fetchartist_id['artist_id']; } 
    
                if(!$fetchl_id['l_id']) {
                    echo 'Could not run query: ' . mysqli_error();
                    $l_iderr ="&errorloc=fetchl_iderr";
                } else { $l_id = $fetchl_id['l_id']; } 
                
                if(!$fetchm_id || !$fetchl_id || !$fetchartist_id) {
                   header("Location: ../create.php?table=Artworks".$m_iderr.$l_iderr.$artist_iderr);
                   exit();
                } 
                
    else {
               DB::update('artworks', [
                'a_title' => $title,
                'm_id' => $m_id,
                'artist_id' => $artist_id,
                'year' => $year,
                'l_id' => $l_id,
                'purchase_date' => $purchase_date,
                'artwork_value' => $artwork_value,
                'img' => $imgdata
               ],
                "a_id=%i", $a_id
            );
    
              header("Location: ../read.php?table=Artworks&newartwork=1&a_id=".$a_id);
              
            
            }
        }
            /*
        }
            
    } */
    
    //
    mysqli_stmt_close($stmt);
    mysqli_close($link);
            }


}