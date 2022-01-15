<?php 
session_start();
$_SESSION['idUsers'];
$_SESSION['aInput'] = "";
if ($_SESSION['userType'] == 'ADMIN') {
include('../header_admin.php');  ?>
<?php $path = '../bggs_arts6/';
        include('../connect.php'); 
 } else {
         include('connect.php');
 } 
 
 ?> 
<h1>Update User</h1>

<?php
if($_GET['update'] == 'success') {
        
        echo '<div class="alert alert-success" role="alert" style="width: 80%; margin-left: 10%;text-align: center;">
        Password successfully updated!
      </div>';
}
include('../connect.php');
$userdetails = DB::queryFirstRow('SELECT * FROM users WHERE idUsers='.$_SESSION['idUsers']); ?>


<form action="crud_includes/user_update2.inc.php" method="post" class="updateUser">
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

<?php include('../includes/modal.php'); ?>

<br>
<footer style="background-color: rgb(244,244,244); width: 100%; height: 10%; left: 0; bottom: 0;">
<br>
<p style="text-align: center; color: black;"><i>Powered by <img src="../img/athena-logo.png" alt="" height="50px"></i> Database management system solutions. Clough and Chiong 2021 &copy;</p>
    <br>
</footer>