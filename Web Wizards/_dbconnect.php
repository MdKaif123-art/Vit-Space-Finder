<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "log";
$conn = mysqli_connect($servername, $username,$password,$db);
if(!$conn)
{
die("unable to connect to with server we are sorry");
}
?>