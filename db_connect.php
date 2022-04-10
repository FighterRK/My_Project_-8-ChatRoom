<?php

$servername="localhost";
$username="root";
$password="";
$database="chatroom";

// Creating Connection

$conn = mysqli_connect($servername,$username,$password,$database);
//check connection

if(!$conn)
{
	die("Failed To Connect".mysqli_connect_error());
}


?>
