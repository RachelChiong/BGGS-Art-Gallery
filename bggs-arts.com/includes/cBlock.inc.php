
<?php 
        require_once 'connect2.php'; 
        $c_artworks = DB::query('SELECT aw_title, aw_pic, aw_location FROM artworksold WHERE aw_location LIKE "C%" ORDER BY aw_location');
        foreach($c_artworks as $row) {
               printf('<div class="loc_card" style="display: block;">
               <img src="img/%s" width="100" alt="%s"class="loc_artwork_img">',$row['aw_pic'], $row['aw_title']);
               echo '<h3><strong>'.$row['aw_title'].'</strong></h3>';
               echo '<p class="title">'.$row['aw_location'].'</p></div>';
             }
        ?>