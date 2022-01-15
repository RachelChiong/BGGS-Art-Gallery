<?php
/// declare variables for the connection to the database so that it can be changed easily if needed. 
$servername = "localhost";
/// No password and username are used to access the database. This could be a security issue when the web app is live to web.
$dBUsername = "root";
$dBPassword = "mysql";
$dBName = "art_database";

///
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

/// Alert users that the connection to the database failed. 
if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
