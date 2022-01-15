<?php
if (isset($_POST['type-submit'])) {
   include "../crud/crud_includes/config.php";
   include("../connect.php");
   $users = DB::query("SELECT * FROM users ORDER BY idUsers");
    $table = $_GET['table'];
    $changed = 0;

    foreach ($users as $row) {
        $typeID = 'changeType'.$row['idUsers'];
        $newType= $_POST[$typeID];
        $sqlquery2 = '"UPDATE users SET '. $_POST[$typeID].', '.$row['idUsers'];
        $sqlquery = 'UPDATE users SET UserType = "'.$_POST[$typeID].'" WHERE users.idUsers = '.$row['idUsers'];
        if ($_POST[$typeID] == $row['UserType']) {
           echo 'no change';
        } else {
            echo 'change initiated <br>';
            DB::query("UPDATE users SET UserType=%s WHERE idUsers=%i", $newType, $row['idUsers']);
            $changed++;
        
            
    }
}

header("Location: ../dashboard.php?table=Users&changed=".$changed);
            exit();


}
