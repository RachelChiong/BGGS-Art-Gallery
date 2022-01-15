    <?php
/// Check if this php page was accessed from 
if (isset($_POST['signup-submit'])) {

    include "dbh.inc.php";
    /// Assigning variables to data collected from the sign up form ('Post' is case sensitive) 
    $fname = $_POST['f_name'];
    $lname = $_POST["l_name"];
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    /// Check whether all the fields are filled out
    if (empty($fname) || empty($lname) || empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
        header("Location: ../signup.php?error=emptyfields&f_name=".$fname."&l_name=".$lname."&uid=".$username."&mail=".$email);
        exit();
    }
   /// Check if there are any underscores in the username
    else if (preg_match("/^[a-z]+_[a-z]+$/i", $username)) {
        header("Location: ../signup.php?error=uidunderscores&f_name=".$fname."&l_name=".$lname."&mail=".$email);
        exit();
    }
    /// Check if the password repeat matches the first password
    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&f_name=".$fname."&l_name=".$lname."&uid=".$username."&mail=".$email);
        exit();
    }
    /// Check if the username is already taken
    else {
        /// Create a prepared SQL statement
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        /// Check if there is a connection error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit(); 
        }
        /// search the database for the same username and store into the 'stmt' variable
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            /// Check that there are no rows containing the username
            $resultCheck = mysqli_stmt_num_rows($stmt);
            /// result check is greater than zero, then username is taken
            if ($resultCheck > 0){
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit(); 
            }
            //
            else {
                $sql = "INSERT INTO users (uidUsers, fname, lname, emailUsers, pwdUsers) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit(); 
                }
                /// All error handlers are cleared
                else {
                    /// Hashing the password to store in the database
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    /// Bind parameters to insert into the database
                    mysqli_stmt_bind_param($stmt, "sssss", $username, $fname, $lname, $email, $hashedPwd);
                    /// Insert user data into the database
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit(); 
                }
            }
        }
    }
    //
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} 
else {
    header("Location: ../signup.php");
    exit();
}
