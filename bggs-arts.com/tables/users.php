<style>
    select .currentOpt {
        background-color: rgb(0,20,137);
        color: white;
    }

    select .newOpt {
        background-color: white;
        color: black;
    }
</style>
<?php 

if(isset($_POST['type-submit'])) {
    
   
    header("Location: ../dashboard.php?table=Users");
}

$order = 'idUsers ASC';
;
$users = DB::query("SELECT * FROM users ORDER BY ".$order);
        echo '<table class="table">';
        echo '<tr class="tb_head">
          <th>ID</th>
          <th>Username</th>
          <th>First name</th>
          <th>Last name</th>
          <th>Email</th>
          <th>User Type</th>';

          foreach($users as $row) {
              echo '<tbody id="gal_table"><tr class="atr"><td><strong>'.$row['idUsers'].'</strong></td>';
            echo '<td>'.$row['uidUsers'].'</td>';
              echo '<td>'.$row['fname'].'</td>';
              echo '<td>'.$row['lname'].'</td>';
              echo '<td>'.$row['emailUsers'].'</td>';
              echo '<td>';


              if ($row['UserType'] == 'STUDENT') {
                $colourType = 'rgb(0,119,200)';
            } else if ($row['UserType'] == 'GENERAL') {
                $colourType = 'rgb(0,178,169)';

            } else if ($row['UserType'] == 'FACILITIES') {
                $colourType = "rgb(160,94,181)";
            } else {
                $colourType = "rgb(255, 88,93)";
            }
              echo '<select name="changeType'.$row['idUsers'].'" class="form-control" style="color: white;background-color:'.$colourType
              .'">
                <option class="currentOpt">'.$row['UserType'].'</option>';
                if ($row['UserType'] == 'STUDENT') {
                    echo '<option class="newOpt">GENERAL</option>
                    <option class="newOpt">FACILITIES</option>
                    <option class="newOpt">ADMIN</option>';
                } elseif ($row['UserType'] == 'GENERAL') {
                    echo '<option class="newOpt">STUDENT</option>
                    <option class="newOpt">FACILITIES</option>
                    <option class="newOpt">ADMIN</option>';
                } elseif ($row['UserType'] == 'FACILITIES') {
                    echo '<option class="newOpt">GENERAL</option>
                    <option class="newOpt">STUDENT</option>
                    <option class="newOpt">ADMIN</option>';
                } elseif ($row['UserType'] == 'ADMIN') {
                    echo '<option class="newOpt">STUDENT</option>
                    <option class="newOpt">FACILITIES</option>
                    <option class="newOpt">GENERAL</option>';
                }

              echo '
                
            </select>
            <input type="number" value ="'.$row['idUsers'].'" name="id'.$row['idUsers'].'" hidden>
             </td></tr>';
          
          };
          echo '</tbody></table></form>';

?>