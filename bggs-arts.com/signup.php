
<?php
    $pagetitle = "Sign Up";
    include "header.php";
?>
<br height="200">
<br>
<main>


    <div class="signup_grid" style="margin-top: 70px; height: 700px;">
        <div class="grid-el" id="signup_header" style="background-image: url(img/Composition_in_Red.jpg);">
        <div  style="margin-top: 20%; text-align: center;">
        <h2 class="bggs_text">BRISBANE GIRLS GRAMMAR SCHOOL</h2>
            <svg height="2" width="400">
             <line x1="0" y1="0" x2="600" y2="0" style="stroke:rgb(255,255,255);stroke-width:5" />
             </svg>
             <h1 style="font-family: 'Times New Roman'; color: white; font-size: 50px;">Sign Up</h1> </div>
</div>
            <div class="grid-el" class="signup_form">
        
                 <div id="SIG_info_text">
                    <h2 style="text-align: center;">Sign Up</h2>
                    <p style="font-family: 'Times New Roman'; text-align: center; width: 50%; margin-left: 25%;">If you are a student user, please enter your student number as your username. </p>
                </div>
                
            <?php
                if (isset($_GET['error'])){
                    if ($_GET['error'] == "emptyfields") {
                        echo '<p class="signuperror">Fill in all the fields.</p>';
                    }
                    else if ($_GET['error'] == "uidunderscore") {
                        echo '<p class="signuperror">Username cannot contain underscores or dashes.</p>';
                    }
                    else if ($_GET['error'] == "passwordcheck") {
                        echo '<p class="signuperror">Passwords do not match.</p>';
                    }
                    else if ($_GET['error'] == "usertaken") {
                        echo '<p class="signuperror">Username is taken.</p>';
                    }
                    else if ($_GET['error'] == "emailused") {
                        echo '<p class="signuperror">An account is already registered using this email.</p>';
                    }
                }
                else if ($_GET['signup'] == "success"){
                    echo '<p class="signupsuccess">Signup successful!</p>';
                }
                ?>
            <form class="form-signup" action="includes/signup.inc.php " method="post">
               

                <?php  
                     
                    //
                    if (!empty($_GET["f_name"])) {
                        echo '<input type="text" name="f_name" placeholder="First Name" label="First Name" value="'.$_GET["f_name"].'">';
                    }
                    else {
                        echo '<input type="text" label="First Name" name="f_name" placeholder="First name">';
                    }

                    if (!empty($_GET["l_name"])) {
                        echo '<input type="text" name="l_name" placeholder="Last Name" value="'.$_GET["l_name"].'">';
                    }
                    else {
                        echo '<input type="text" name="l_name" placeholder="Last name">';
                    }
                    //
                    if (!empty($_GET["uid"])) {
                        echo '<input type="text" name="uid" placeholder="Username/Student No." value="'.$_GET["uid"].'">';
                    }
                    else {
                        echo '<input type="text" name="uid" placeholder="Username/Student No.">';
                    }

                    //
                    //
                    if (!empty($_GET["mail"])) {
                        echo '<input type="email" name="mail" placeholder="E-mail" value="'.$_GET["mail"].'">';
                    }
                    else {
                        echo '<input type="email" name="mail" placeholder="E-mail">';
                    }
                ?>


                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                <button type="submit" name="signup-submit">Sign up</button>
            </form>
            <div style="text-align: center;"><br>
               <p>Already have an account?</p>

               <button class="open-button" onclick="openForm()" style="margin-left: 35%;">Login</button> <br>

            <div class="login_modal">
            <div class="form-popup" id="myForm">
            <form action="includes/login.inc.php" class="form-container" method="post">
                <h1>Login</h1>

                <?php
            
                if (isset($_SESSION['id'])) {
                    /// Declare a variable to store the 'user type'.
                    $uType= $_SESSION['userType'];
                    /// Check if the user is a student
                    if ($uType == "STUDENT") {
                        echo '<p id="userType">Logged in as: STUDENT</p>'; 
                    } else {
                        /// As the default user type is general, all other users must be 'general'
                        echo '<p id="userType">Logged in as: GENERAL</p>';
                    };
                    
                    echo '<form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                    </form>';
                }
                else {
                    echo '<form action="includes/login.inc.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/email">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                </form>';
                }
                ?>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
            </div>
            </div>
            <script>
            function openForm() {
            document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
            document.getElementById("myForm").style.display = "none";
            }
            </script>
        </div>
        </div>
    
    
        
    
</main>

<?php
    include "footer.php";
?>
