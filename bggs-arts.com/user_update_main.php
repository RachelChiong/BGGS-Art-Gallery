<style>
    .updateUser input {
        width: 70%;
        font-size: 16px;

    }
</style>
<?php 
session_start();
include('header.php');
$title = "User Profile";
?>

   <!-- <div class='header_banner' width="100%" style="max-height: 600px;">
            <img src="img/window-header.jpg" id="splash" style="display: hidden;">
            <h2 class="bggs_text" style="text-align: center; font-size: 200">BRISBANE GIRLS GRAMMAR SCHOOL</h2>
            <svg height="2" width="600">
             <line x1="0" y1="0" x2="600" y2="0" style="stroke:rgb(255,255,255);stroke-width:5" />
             </svg>
             <?php 
            echo "<i><h1 class='page_title'>". $title . "</h1></i>"
             ?>       

</div> -->
<style>
    .header_banner {
  padding: 0;
  margin-top: 70px;
  text-align: center;
  background: url('img/window-header.jpg') no-repeat;
  overflow: hidden;
  width: 100%;
  color: white;
  font-size: 30px;
  height: 400px;
}

/* Page Content */
.content {
background-color: rgb(0,0,0,0.5);
width: 100%;
margin-left: -10;
height: 400px;
padding: 0;
padding-top: 10%;
}

.content h2 {
    font-size: 30px;
}
.content h1 {
    font-size: 100px;
}
</style>
/* Header/Logo Title */

</style>
</head>
<body>

<div class="header_banner">
<div class="content">
<h2 class="bggs_text" style="text-align: center; font-size: 30">BRISBANE GIRLS GRAMMAR SCHOOL</h2>
    <svg height="2" width="600">
        <line x1="0" y1="0" x2="600" y2="0" style="stroke:rgb(255,255,255);stroke-width:5" />
        </svg>
        <?php 
    echo "<i><h1 class='page_title' style='text-align: center'>". $title . "</h1></i>"
        ?> 
</div>
      
</div>
<?php
include('connect.php');
$userdetails = DB::queryFirstRow('SELECT * FROM users WHERE idUsers='.$_SESSION['idUsers']); ?>


<form action="crud/crud_includes/user_update.inc.php" method="post" class="updateUser">
<table style="width: 80%; margin-right: 10%; margin-left: 10%">
<tr><td><label for="user_id">User ID</label></td><td>
<input id="user_id" type="number" name="idUsers" value ="<?php echo $userdetails['idUsers'] ?>" disabled></td></tr>

<tr><td><label for="username">Username</label></td><td>
<input id="username" type="text" name="uidUsers" value ="<?php echo $userdetails['uidUsers'] ?>" disabled></td></tr>

<tr><td><label for="First_name">First Name</label></td><td>
<input id="First_name" type="text" name="fname" value ="<?php echo $userdetails['fname'] ?>" disabled></td></tr>

<tr><td><label for="Last_name">Last Name</label></td><td>
<input id="Last_name" type="text" name="lname" value ="<?php echo $userdetails['lname'] ?>" disabled></td></tr>

<tr><td><label for="Email">Email</label></td><td>
<input id="Email" type="email" name="emailUsers" value ="<?php echo $userdetails['emailUsers'] ?>" disabled></td></tr>

<tr>
<td width="40%"><label>Current Password</label></td>
<td width="60%"><input type="password" name="password" class="txtField"/><span id="password"  class="required"></span></td>
</tr>
<tr>
<td><label>New Password</label></td>
<td><input type="password" name="newpassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<td><label>Confirm Password</label></td>
<td><input type="password" name="confirmnewpassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
</tr>

</table>
<div style="text-align: center; margin-top: 10px">
<button style="font-size: 20px; color: white; background-color: rgb(0,27,137); padding: 10px; margin-bottom: 10px" type="submit" name="user-submit" class="btn btn-primary mb-2">Update Details</button>
</form></div>

<?php include('includes/modal.php'); ?>



<?php 
include 'footer.php'; ?>
disabled