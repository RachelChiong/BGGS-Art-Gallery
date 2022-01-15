<?php $locations = DB::query("SELECT * FROM locations");
        echo '<table class="table">';
        echo '<tr class="tb_head">
          <th>Location ID</th>
          <th>Actions</th>
          <th>Room</th>
          <th>Building</th>
          <th>Floor</th>';

          foreach($locations as $row) {
              echo '<tbody id="gal_table"><tr class="atr"><td><strong>'.$row['l_id'].'</strong></td>';
              echo "<td>";
              echo "<a href='crud/read.php?table=Locations&l_id=". $row['l_id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
              echo "<a href='crud/update.php?l_id=". $row['l_id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
              echo "<a href='crud/delete.php?l_id=". $row['l_id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
          echo "</td>";
              echo '<td>'.$row['room'].'</td>';
              echo '<td>'.$row['building'].'</td>';
              echo '<td>'.$row['floor'].'</td>';
          }
          echo '</tbody></table>';

?>