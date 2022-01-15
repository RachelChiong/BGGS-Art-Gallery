<?php
    $pagetitle = "Locations";
    include "header.php";
?>

    <main>
        <div class="wrapper-main"> 
            <?php $title = "Locations"; include "splash_title.php"; ?>
            <?php
                if ($uType =="STUDENT" OR $uType =="FACILITIES" OR $uType == "ADMIN") {
                    include "locations_student.php";

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
                }
                else {
                    include "locations_general.php";
                }
            ?>
        </div>    
    </main>
   
<?php
    include("footer.php");
?>