<style>
 /* The Modal (background) */
 .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 30px;
  border: 1px solid #888;
  border-radius: 5px;
  width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
} 

#mybtn {
    
}
</style>
 <!-- Trigger/Open The Modal --><div style="text-align: center;"> 
 <button id="myBtn" style="font-size: 20px; color: rgb(0,27,137); background-color: white; padding: 10px; margin-bottom: 10px;" >View Privacy Statement</button></div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>User Data Privacy Statement</h2>
    <p>User data that is filled into this form is handled in a secure way and is stored on a database so that users may log in again. The BGGS art collection aims to and currently follows the most up to date Australian Privacy Act (1988) (APP 1). <br> General users maintain the right to use a pseudonym and anonymous username, however members of the BGGS staff faculties and students are required to use their allocated login with credentials issued by BGGS (APP 2). <br>By submitting this form and using this website when logged in, you solicit the using of this information within the BGGS Art Collection that is moderated by administrators (APP 5, 6). Passwords stored on the server are encrypted (APP 3). <br>Only the required data (as per the placeholders and labels of respective fields) are to be inputted into the system. No additional data will be stored (APP 4). All user data will be stored safely on the databases, which are protected from SQL injection (APP 11), the user data is not used on any pages. 

<br>Users are given to opportunity the access their personal data: to view what data is stored on the database (APP 12). They are given the opportunity to view their own details and credentials: including their first and last name, email and username. Users are also able to change their password (APP 13). Due to coding constraints, ‘forgot password’ feature is currently unavailable. 
</p>
  </div>

</div> 

<script>
    // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 
</script>