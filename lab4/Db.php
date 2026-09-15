<?php
$con  = new mysqli("localhost","root","","admission_db");
if ($con->connect_error){
    die("Failed to Connect to Database");
}
?>
