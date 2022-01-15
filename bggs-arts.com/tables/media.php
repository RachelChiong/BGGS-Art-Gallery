<?php 
$order = 'm_id ASC';
$media = DB::query("SELECT * FROM media ORDER BY ".$order);
        echo '<table class="table">';
        echo '<tr class="tb_head">
          <th>Media ID</th>
          <th>Actions</th>
          <th>Collection</th>
          <th>Media Name</th>';

          foreach($media as $row) {
              echo '<tbody id="gal_table"><tr class="atr"><td><strong>'.$row['m_id'].'</strong></td>';
              echo "<td>";
              echo "<a href='crud/read.php?table=Media&m_id=". $row['m_id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'> </span></a>";
              echo "<a href='crud/update.php?id=". $row['m_id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'> </span></a>";
              echo "<a href='crud/delete.php?id=". $row['m_id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'> </span></a>";
          echo "</td>";
          echo '<td>'.$row['collection'].'</td>';
              echo '<td>'.$row['m_name'].'</td>';
          
          };
          echo '</tbody></table>';

?>