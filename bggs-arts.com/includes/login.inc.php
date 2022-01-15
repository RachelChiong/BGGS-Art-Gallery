<?php
/// Check that this file has not been accessed directly:
if (isset($_POST['login-submit'])) {
    /// Connect to the database
    include "dbh.inc.php";
    
    /// retrieve and declare variables from the submitted form
    $mailuid = mysqli_escape_string($conn, $_POST['mailuid']);
    $password = mysqli_escape_string($conn, $_POST['pwd']);

    /// Check if any fields are empty
    if (empty($mailuid) || empty($password)) {
        header("Location: ../index.php?error=emptyfields&mailuid=".$maiiluid);
        exit();
    }
    //
    else {
        $sql = "SELECT * FROM users WHERE uidUsers='$mailuid' OR emailUsers='$mailuid'";
        $result = mysqli_query($conn, $sql);
        $resultsCheck = mysqli_num_rows($result);
        /// Check whether the username/email entered is valid and a corresponding account is stored in the database
        if ($resultsCheck < 1) {
            header ("Location: ../index.php?login=error");
            exit(); 
        } else {
            /// Check whether the password matches what is in the database (once unscrambled)
            if ($row = mysqli_fetch_assoc($result)) {
                /// Unscramble the password:
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                /// Incorrect password:
                if ($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                } 
                //
                /// Correct password:
                else if ($pwdCheck == true) {
                    session_start();
                    /// retriving the user ID (to validate whether the user has logged in)
                    $_SESSION['idUsers'] = $row['idUsers'];
                    /// Retrieve other information about the user. 
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['lname'] = $row['lname'];
                    $_SESSION['uid'] = $row['uidUsers'];
                    $_SESSION['mail'] = $row['mailUsers'];
                    /// Retrieve the type of user
                    $_SESSION['userType'] = $row['UserType'];
                    
                    if ($row['UserType'] =='ADMIN'){
                        $_SESSION['userType'] = $row['UserType'];
                        $_SESSION['idUsers'] = $row['idUsers'];
                        header("Location: ../dashboard.php?table=Artworks&resetsearch=");
                        
                    } else {
                    header("Location: ../index.php??login=success");
                    }
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php?error=wrongpwd");
    exit();
}
