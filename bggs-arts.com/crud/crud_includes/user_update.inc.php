<?php
/// Check if this php page was accessed from 
if (isset($_POST['user-submit'])) {

    /// Assigning variables to data collected from the sign up form ('Post' is case sensitive) 
   include("../../connect.php");
   include("dbh.inc.php");
 
            $idUsers = $_POST['idUsers'];
            $password = $_POST['password'];
            $newpassword = $_POST['newpassword'];
            $confirmnewpassword = $_POST['confirmnewpassword'];
            
            if(empty($password) || empty($newpassword) || empty($confirmnewpassword)) {
                header("Location: ../../user_update_main.php?error=emptyfields");
                exit();
            } else {
            // Source: https://phppot.com/php/php-change-password-script/
            $sql = "SELECT * FROM users WHERE idUsers=4";
            $result = mysqli_query($conn, $sql);
            // Verify the existing password
            if ($row = mysqli_fetch_assoc($result)) {
                /// Unscramble the password:
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                /// Incorrect password:
                if ($pwdCheck == false) {
                    header("Location: ../../user_update_main.php?error=wrongpwd");
                    exit();
                } 
                //
                /// Correct password:
                else if ($pwdCheck == true) {
                if ($newpassword != $confirmnewpassword) {
                    header("Location: ../../user_update_main.php?error=passmatch");
                    exit();

                } else {
                     /// Hashing the new password to store in the database
                     $hashedPwd = password_hash($newpassword, PASSWORD_DEFAULT);

                     DB::update('users', ["pwdUsers" => $hashedPwd], "idUsers=%i", 4);
                     header("Location: ../../user_update_main.php?update=success");
                     exit();
                }
            } else {
                header("Location:../../user_update_main.php?error=elseif");
                exit();
            }
            } else {
                header("Location:../../user_update_main.php?error=fetchassoc");
                exit();
            }
        }
    } else {
        header("Location: ../../user_update_main.php?error=sqlerr"); exit(); }
           
          ?>