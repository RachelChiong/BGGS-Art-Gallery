<?php 
$artists = DB::query("SELECT artist_id, a_fname, a_lname,  CONCAT(a_fname,' ', a_lname) AS 'Artist_Name' FROM artists");
        echo '<table class="table">';
        echo '<tr class="tb_head">
          <th>Artist ID</th>
          
          <th>First Name</th>
          <th>Last Name</th>
          <th>Actions</th>';

          foreach($artists as $row) {
              echo '<tbody id="gal_table"><tr class="atr"><td><strong>'.$row['artist_id'].'</strong></td>';
              
              echo '<td>'.$row['a_fname'].'</td>';
              echo '<td>'.$row['a_lname'].'</td>';
              echo "<td>";
              echo "<a href='crud/read.php?table=Artists&artist_id=". $row['artist_id'] ."' title='View Record' data-toggle='tooltip'><span><img alt='read' src='img/scroll.png' width='24px'></span>  </a>";
              echo "<a href='crud/update.php?id=". $row['artist_id'] ."' title='Update Record' data-toggle='tooltip'><span><img alt='edit' src='img/edit-button.png' width='24px'></span></a>";
              echo "<a href='crud/delete.php?table=Artists&id=". $row['artist_id'] ."' title='Delete Record' data-toggle='tooltip'><span> <img alt='delete' src='img/delete.png' width='24px'></span></a>";
          echo "</td>";
          }
          echo '</tbody></table>';

?>